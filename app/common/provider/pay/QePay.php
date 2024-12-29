<?php

namespace app\common\provider\pay;

use app\api\logic\Recharge;
use util\HttpClient;
use think\exception\ValidateException;

class QePay
{
    protected $notify_url; //代收回调
    protected $cash_notify_url; //代付回调
    protected $config = [
        'pay_url'           => 'https://payment.qeapay.com/pay/web', //支付url
        'cash_url'          => 'https://payment.qeapay.com/pay/transfer',//代付url
        'cash_query_url'    => 'https://payment.qeapay.com/query/transfer', //代付查询url
        'mch_query_url'     => 'https://payment.qeapay.com/query/balance', // 查询余额url
        'mch_id'            => '887003002', // 商户号
        'mch_key'           => 'a3a0b75ae9964c7ab08d8b8125cb6715', //支付秘钥
        'cash_mch_key'      => 'QMHYTGCP3CSHQROIMRI9FATYKQ1HPQ3Q', //代付秘钥
        'version'           => '1.0',
        'sign_type'         => 'MD5',
        'pay_type'          => '720',
        'page_url'          => ''
    ];

    public function __construct()
    {
        $this->notify_url       = request()->domain().'/api/order/payNotify?pay_type=QePay';
        $this->cash_notify_url  = request()->domain().'/api/order/cashNotify?pay_type=QePay';
    }

	/**
	 * 代收
	 * @param string $order_sn 订单号
	 * @param $amount 金额
	 * @return mixed
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @author wbufan
	 * @Time: 2022/11/18 21:15
	 */
    public function recharge(string $order_sn = '', $amount = 0)
    {
        $data = [
            'mch_id'            => $this->config['mch_id'],
            'goods_name'        => 'Balance recharge',
            'mch_order_no'      => $order_sn,
            'pay_type'          => $this->config['pay_type'],
            'trade_amount'      => $amount,
            'order_date'        => date('Y-m-d H:i:s'),
            'mch_return_msg'    => 'QePay',
            'notify_url'        => $this->notify_url,
            'page_url'          => $this->config['page_url'],
            'version'           => $this->config['version'],
        ];
        $data['sign']           = $this->sign($data);
        $data['sign_type']      = $this->config['sign_type'];
        $result = HttpClient::post($this->config['pay_url'], $data);
        if ($result['respCode'] != 'SUCCESS' || $result['tradeResult'] != 1) {
            throw new ValidateException( $result['tradeMsg'] ?? __('PayInfo get fail'));
        }
        $retSign = $result['sign'];
        unset($result['sign']);
        unset($result['signType']);
        if ($retSign != $this->sign($result)) {
            throw new ValidateException(__('PayInfo get fail'));
        }
		return $result['payInfo'];
    }

	/**
	 *
	 * 代付
	 * @param $order
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \think\Exception
	 * @author wbufan
	 * @Time: 2022/11/18 21:57
	 */
    public function withdraw($order)
    {
        $available_amount = $this->mchQuery();
        if ($available_amount < $order['get_price']) {
            throw new ValidateException('商户可用余额不足');
        }
        $data = [
            'mch_id'            => $this->config['mch_id'],
            'mch_transferId'    => $order['order_sn'],
            'transfer_amount'   => intval($order['get_price']),
            'apply_date'        => date('Y-m-d H:i:s'),
            'bank_code'         => $order['bank_code'],
            'receive_name'      => $order['name'],
            'receive_account'   => $order['account'],
            'back_url'          => $this->cash_notify_url,
            'remark'            => 'cash',
            'document_type'     => 'CPF',
            'document_id'       => $order['cpf'],
        ];
        $data['sign']           = $this->sign($data, 'cash');
        $data['sign_type']      = $this->config['sign_type'];
        $result = HttpClient::post($this->config['cash_url'], $data);
        if ($result['respCode'] != 'SUCCESS') {
            throw new ValidateException( $result['errorMsg'] ?? '代付提交失败');
        }
        $retSign = $result['sign'];
        unset($result['sign']);
        unset($result['signType']);
        if ($retSign != $this->sign($result, 'cash')) {
            throw new ValidateException('代付提交异常');
        }
        return true;
    }

	/**
	 * 签名
	 * @param $data
	 * @param $type
	 * @return string
	 * @author wbufan
	 * @Time: 2022/11/12 17:47
	 */
	protected function sign($data,$type = 'pay')
    {
        ksort($data);
        $signData = [];
        foreach ($data as $key => $val) {
            if ($val != '') {
                $signData[] = $key.'='.$val;
            }
        }
        $signSource = implode('&', $signData);
        if (!empty($this->config['mch_key'])) {
            $signSource = $signSource."&key=".($type == 'pay' ? $this->config['mch_key'] : $this->config['cash_mch_key']);
        }
        return md5($signSource);
    }

	/**
	 * 验签
	 * @param array $data
	 * @param $type
	 * @return bool
	 * @author wbufan
	 * @Time: 2022/11/12 17:48
	 */
	protected function validateSign(array $data, $type = 'pay')
    {
        $sign = $data['sign'];
	    unset($data['sign'], $data['signType']);
        $signKey = $this->sign($data, $type);
        return $signKey == $sign ? true : false;
    }

	/**
	 * 上分
	 * @param array $data
	 * @return string
	 * @throws \think\db\exception\DataNotFoundException
	 * @author wbufan
	 * @Time: 2022/11/12 18:29
	 */
	public function topScore(array $data)
	{
		unset($data['pay_type']);
		// 验签
		if(!$this->validateSign($data)){
			throw new ValidateException( $result['errorMsg'] ?? 'Signature verification failed');
		}
		if($data['tradeResult'] == 1){
			if((new Recharge())->paySuccess($data['mchOrderNo'], $data['orderNo'], floatval($data['amount']), $data)){
				return 'success';
			}
		}
		return 'fail';
	}

	protected function mchQuery()
    {
        $data = [
            'mch_id' => $this->config['mch_id'],
        ];
        $data['sign'] = $this->sign($data, 'cash');
        $data['sign_type'] = 'MD5';
        $result = HttpClient::post($this->config['mch_query_url'], $data);
        if ($result['respCode'] != 'SUCCESS') {
            throw new \think\Exception( $result['errorMsg'] ?? '商户余额查询失败');
        }
        $retSign = $result['sign'];
        unset($result['sign'],$result['signType'],$result['respCode'],$result['errorMsg']);
		// 暂不确定 查询余额得加密key 是用代付还是代收 暂注释
//		if($retSign != $this->sign($result)){
//			throw new \think\Exception( $result['errorMsg'] ?? '验签失败');
//		}
        return $result['availableAmount'];
    }
}