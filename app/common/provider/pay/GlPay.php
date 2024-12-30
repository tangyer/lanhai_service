<?php

namespace app\common\provider\pay;

use app\api\logic\Recharge;
use think\exception\ValidateException;

class GlPay extends BasePay
{
    protected $notify_url; //代收回调
    protected $cash_notify_url; //代付回调

    protected $config = [
        'pay_url'           => 'https://cnmss.lryok.com/ty/orderPay', //支付url
        'cash_url'          => 'https://sruis.lryok.com/withdraw/singleOrder',//代付url
        'mch_id'            => '861100000033178',  //商户号替换成自己的
        'md5_key'           => '5B8F9493253D97A9EA413F20A46DC1B4', //Md5密匙替换成自己
        'mch_public_key'    => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCRC2BImd8iGDqNjc28HA+RZt8OTVslBtFGmG1/Jfs5arSqwhslEIY8aQzhos+0ILnT5X1beMnPsxW7cSRg/Y08yBwpMnTYhlc4ZSxY7usl5zUw+xVOb9XqvnxbL/6GWyr4k1WqYJJDG4y5uc31qsUDDs0zH+k+0Uj4UuuqGfdsEwIDAQAB',  //商户公钥替换自己的
        'mch_private_key'   => 'MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAJELYEiZ3yIYOo2NzbwcD5Fm3w5NWyUG0UaYbX8l+zlqtKrCGyUQhjxpDOGiz7QgudPlfVt4yc+zFbtxJGD9jTzIHCkydNiGVzhlLFju6yXnNTD7FU5v1eq+fFsv/oZbKviTVapgkkMbjLm5zfWqxQMOzTMf6T7RSPhS66oZ92wTAgMBAAECgYEAjJbeSQD8y2t4teSRWphIbsOryY0pn4YwK6Fr4SbLkCfh3vIupYqS0tNwbPUHJq3h8YYsMBGwa+ZGVl2gyXJ7Bs0t5/dEnHD5ArMTxhSc+CqKt54Y0b1/Z4U9XiU+qG1gkkZS5Gcxjwyc0kUW2M6uga46N2WrjkHnDWs+4spCXuECQQDMTrpXEHAwgmmvLssOlSgm56aI3FBKiI0UOlBEbI0P0KaDZc4OPg5BE/AmKlTDt84Mcg1PDw0JJJbq/0kv6PJHAkEAtb4ZMPArDqPWKG6EipT37xI6HhM1WNU4YI3jpECoiJaYH65vZB4M+uvz0bp+uOMRdj4LddPX8JTmawRjlefx1QJBALaSn/hPq0HeOJ0g3rpgVio2Fl71KhcA4bmyxqnuqzv3w+Vl43ZcxBYpwBALAgaISWxbu0Lr+0UxWmAT044px98CQFCgPui5A0EBafaR4Pbh04QZ3/KLrvTz0ojzKXQqwxmlRWN4rS4LLtL6bjYyuBkpkwuTxt3E112BkR8U2WEdfukCQDujWa09aQEGBCgw1w2uWiOJsuaOSefpF1DfVmHTwSsM7tj3hqoDiDivQWe//ftW2Ua+n1V6tIRK8udLWaVFcOE=',  //商户私钥替换自己的
        'page_url'          => '',   // 支付成功后跳转页面
        'ccy_no'            => 'INR', // 币种编码
        'busi_code'         => '100701', // 支付类型编码
    ];

    public function __construct()
    {
        $this->notify_url       = request()->domain().'/api/order/payNotify?pay_type=GlPay';
        $this->cash_notify_url  = request()->domain().'/api/order/cashNotify?pay_type=GlPay';
    }

    public function create($order)
    {
        $data['mer_no']         = $this->config['mch_id'];
        $data['mer_order_no']   = $order['sn'];
        $data['pname']          = 'user';//此处只能是字母  用户名可以包含数字不支持
        $data['pemail']         = 'test@mail.com';
        $data['phone']          = $order['mobile'] ?? '12345';//限制只能为数字号码 USDTTRC支付手机号必须填真实的 肯尼亚手机号必须真实有效
        $data['order_amount']   = $order['amount'];
        $data['ccy_no']         = $this->config['ccy_no'];
        $data['busi_code']      = $this->config['busi_code'];
        $data['notifyUrl']      = $this->notify_url;##回调地址
        $data['pageUrl']        = $this->config['page_url'];##跳转地址

        $data = $this->encrypt($data);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $ret = $this->http_post($this->config['pay_url'],$data);

        $res = json_decode($ret,true);
	    return $res['order_data'];
    }

    public function withdraw($order)
    {
        $data['acc_no']         = $order['account'];
        $data['mer_no']         = $this->config['mch_id'];
        $data['mer_order_no']   = $order['mer_order_no'];
        $data['acc_name']       = 'user';
        $data['ccy_no']         = $this->config['ccy_no'];
        $data['order_amount']   = $order['order_amount'];
        $data['bank_code']      = 'MXNSTP';##	银行编码
        $data['mobile_no']      = $order['mobile'];//限制只能为数字号码
        $data['summary']        = 'summary';##备注
        $data['notifyUrl']      = $this->cash_notify_url;//回调地址 代付成功失败都走回调
        $data['pageUrl']        = $this->config['page_url'];

        $data = $this->encrypt($data);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $ret = $this->http_post($this->config['cash_url'],$data);
        return json_decode($ret, true);
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
		if($data['status'] == 'SUCCESS'){
			if((new Recharge())->paySuccess($data['mer_order_no'], $data['order_no'], floatval($data['pay_amount']), $data)){
				return 'SUCCESS';
			}
		}
		return 'FAIL';
	}


	/**
	 * http post请求
	 * @param $url
	 * @param $postData
	 * @return false|string
	 * @author wbufan
	 * @Time: 2022/11/12 18:42
	 */
	protected function http_post($url, $postData)
    {
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/json',
                'content' => $postData,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

	//支付加密
	protected function encrypt($data){
		ksort($data);
		$str = '';
		foreach ($data as $k => $v){
			if(!empty($v)){
				$str .= $k.'='.$v.'&';
			}
		}
		$str = rtrim($str,'&');
		$pem = chunk_split($this->config['mch_private_key'], 64, "\n");
		$pem = "-----BEGIN PRIVATE KEY-----\n" . $pem . "-----END PRIVATE KEY-----\n";
		$private_key = openssl_pkey_get_private($pem);
		$crypto = '';
		foreach (str_split($str, 117) as $chunk) {
			openssl_private_encrypt($chunk, $encryptData, $private_key);
			$crypto .= $encryptData;
		}
		$encrypted = base64_encode($crypto);
		$encrypted = str_replace(array('+','/','='),array('-','_',''),$encrypted);
		$data['sign'] = $encrypted;
		return $data;
	}

	//解密
	protected function decrypt($data){
		ksort($data);
		$toSign ='';
		foreach($data as $key=>$value){
			if(strcmp($key, 'sign') != 0  && $value!=''){
				$toSign .= $key.'='.$value.'&';
			}
		}
		$str = rtrim($toSign,'&');
		//替换自己的公钥
		$pem = chunk_split( $this->config['mch_public_key'],64, "\n");
		$pem = "-----BEGIN PUBLIC KEY-----\n" . $pem . "-----END PUBLIC KEY-----\n";
		$public_key = openssl_pkey_get_public($pem);
		$base64 = str_replace(array('-', '_'), array('+', '/'), $data['sign']);
		$crypto = '';
		foreach(str_split(base64_decode($base64), 128) as $chunk) {
			openssl_public_decrypt($chunk,$decrypted,$public_key);
			$crypto .= $decrypted;
		}
		if($str != $crypto){
			return false;
		}
		return $crypto;
	}
}