<?php

namespace Util;

use app\common\provider\account\FundAccount;
use think\facade\Log;
use Udun\Dispatch\UdunDispatch;
use Udun\Dispatch\UdunDispatchException;

class Udun {

	protected $udunDispatch;

	public $api_key = '9140f635d16239c18ccc53b7d53c1b7d';

	public function __construct()
	{
		// 控制器初始化
		$this->initialize();
	}
	protected function initialize(){
		$this->udunDispatch = new UdunDispatch([
			'merchant_no' => 310580, //商户号
			'api_key' => $this->api_key,//apikey
			'gateway_address'=>'https://sg02.udun.io', //节点
			'callUrl'=> env('API_URL') . '/udun/callback', //回调地址
			'debug' => true  //调试模式
		]);
	}


	//查询支持的交易对
	public function supportCoins()
	{
		$result =  $this->udunDispatch->supportCoins(true);
		return $result;
	}


	//创建地址
	public function createAddress($mainCoinType = '0')
	{
		$result =  $this->udunDispatch->createAddress($mainCoinType);
		return $result;
	}

	//验证地址合法性
	public function checkAddress($mainCoinType = '0',$address = '')
	{
		$result =  $this->udunDispatch->checkAddress($mainCoinType,$address);
		return $result;
	}

	//查询地址是否存在
	public function existAddress($mainCoinType = '0',$address = '')
	{
		$result =  $this->udunDispatch->existAddress($mainCoinType,$address);
		return $result;
	}

	//申请提币
	public function withdraw($order_sn,$mainCoinType = '0',$coinType = '0',$address = '',$amount = 0)
	{
		$result =  $this->udunDispatch->withdraw($order_sn,$mainCoinType,$coinType,$address,$amount);
		return $result;
	}

	//交易回调
	public function callback()
	{
		$body =  $_POST['body'];
		$nonce = $_POST['nonce'];
		$timestamp = $_POST['timestamp'];
		$sign = $_POST['sign'];
		//接收回调参数 用于日志记录
		$content = file_get_contents('php://input');
		//$this->printLog("回调接收内容:".$content);

		Log::info('Udun回调：'.json_encode($content));
		Log::info('Udun回调body：'.json_encode($body));
		//验证签名
		$signCheck = md5($body.$this->api_key.$nonce.$timestamp);
		if ($sign != $signCheck) {
			throw new UdunDispatchException(-1, '签名错误');
			return ;
		}
		$body = json_decode($body);
		//$this->printLog("回调接收内容(tradeType):".$body->tradeType);
		//$body->tradeType 1充币回调 2提币回调
		if ($body->tradeType == 1) {
			//$body->status 0待审核 1审核成功 2审核驳回 3交易成功 4交易失败
			if($body->status == 3){
				$res = (new \app\api\logic\Udun())->findOne(['address'=>$body->address],false);

				//业务处理
				if($res){
					$data['type']              = $res->type;
//					$data['receive_address']   = $body->address;
					$data['trade_address']     = $body->address;
					$data['status']            = 1;
					$data['member_id']         = $res->member_id;
					$data['amount']            = $body->amount / 1000000;
					$data['recharge_time']     = time();
					$data['trade_hash']        = $body->txId;

					$recharge = (new \app\api\model\Recharge());
					$saveRes = $recharge->create($data);
					$account = new FundAccount();
					$account->recharge([
						'relation_id'   => $saveRes->id,
						'member_id'     => $res->member_id,
						'amount'        => $body->amount / 1000000,
					]);
				}
			}
			//无论业务方处理成功与否（success,failed），回调都认为成功
			return "success";

		} elseif ($body->tradeType == 2) {

			//$body->status 0待审核 1审核成功 2审核驳回 3交易成功 4交易失败
			if($body->status == 0){
				//业务处理
			}
			else if($body->status == 1){
				//业务处理
			}
			else if($body->status == 2){
				//业务处理
			}
			else if($body->status == 3){
				//业务处理
			}
			else if($body->status == 4){
				//业务处理
			}
			//无论业务方处理成功与否（success,failed），回调都认为成功
			return "success";
		}
	}
}
