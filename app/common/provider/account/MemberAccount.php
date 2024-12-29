<?php

namespace app\common\provider\account;

class MemberAccount extends BaseAccount
{

    protected string $accountType = 'fund';

    /**
     * 充值
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function recharge(array $data = []){
        $data['trans_type'] = 'recharge';
		$this->income($data);
    }

	/**
	 * 提现
     *
	 * @param array $data
	 * @return void
	 */
	public function withdraw(array $data = []){
		$data['trans_type'] = 'cash';
		$this->cash($data);
	}

    /**
     * 注册
     * @param array $data
     * @return void
     */
    public function register(array $data = []){
        $data['trans_type'] = 'register';
        $this->income($data);
    }


}