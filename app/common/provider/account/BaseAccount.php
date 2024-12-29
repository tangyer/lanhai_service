<?php

namespace app\common\provider\account;

use app\common\model\Config;
use app\common\model\Currency;
use app\common\model\Member;
use app\common\model\MemberAccount;
use app\common\model\MemberAccountRecord;
use think\db\exception\DataNotFoundException;
use think\exception\ValidateException;

abstract class BaseAccount
{

    const TRADE_IN  = 1; // 收入

    const TRADE_OUT = 2; // 支出


    /**
     * 账户类型
     * @var string
     */
    protected string $accountType = '';


    /**
     * 获取会员账户
     * @param $memberId
     * @param string $currency
     * @return MemberAccount
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getMemberAccount($memberId)
    {
        $memberAccount = MemberAccount::where([
            'member_id'     => $memberId,
        ])->find();
        if (!$memberAccount){
            // 创建用户账户
            $memberAccount = MemberAccount::create([
                'member_id'             => $memberId,
                'balance'               => 0,
                'withdraw_balance'      => 0,
                'freeze_balance'        => 0,
                'recharge_amount'       => 0,
                'withdraw_amount'       => 0,
                'order_profit'          => 0,
                'commission1'           => 0,
                'commission2'           => 0,
                'commission3'           => 0,
            ]);
        }
        return $memberAccount;
    }

    /**
     * 收入
     * @param array $data
     * @throws \Exception
     */
    public function income(array $data = [],$field = 'balance')
    {
        $this->validateMemberAccountRecord($data);
        $memberAccount = $this->getMemberAccount($data['member_id']);
        $memberAccount->$field += $data['amount'];
        if($data['trans_type'] == 'recharge'){
            $memberAccount->recharge_amount += $data['amount'];
        }
        $memberAccount->save();

        MemberAccountRecord::create([
            'relation_id'   => $data['relation_id'],
            'member_id'     => $data['member_id'],
            'trade_type'    => self::TRADE_IN,
            'trans_type'    => $data['trans_type'],
            'amount'        => $data['amount'],
            'balance'       => $memberAccount->$field,
            'create_time' => time(),
        ]);
    }

    public function orderExpend(array $data = [],$field = 'balance')
    {
        $this->validateMemberAccountRecord($data);
        $memberAccount = $this->getMemberAccount($data['member_id']);
        $memberAccount->$field -= $data['amount'];
        $memberAccount->save();
        MemberAccountRecord::create([
            'relation_id'   => $data['relation_id'],
            'member_id'     => $data['member_id'],
            'trade_type'    => self::TRADE_OUT,
            'trans_type'    => $data['trans_type'],
            'amount'        => $data['amount'],
            'balance'       => $memberAccount->$field,
            'create_time' => time(),
        ]);
    }

    /**
     * 支出
     * @param array $data
     * @throws \Exception
     */
    public function expend(array $data = [],$field = 'balance')
    {
        $this->validateMemberAccountRecord($data);
        $memberAccount = $this->getMemberAccount($data['member_id']);
//        if ($memberAccount->$field < $data['amount']){
//            throw new ValidateException(lang('balance_not_enough'));
//        }
        $memberAccount->$field -= $data['amount'];
        $memberAccount->save();
        MemberAccountRecord::create([
            'relation_id'   => $data['relation_id'],
            'member_id'     => $data['member_id'],
            'trade_type'    => self::TRADE_OUT,
            'trans_type'    => $data['trans_type'],
            'amount'        => $data['amount'],
            'balance'       => $memberAccount->$field,
            'create_time' => time(),
        ]);
    }

	/**
	 * 支出
	 * @param array $data
	 * @throws \Exception
	 */
	public function cash(array $data = [])
	{
		$this->validateMemberAccountRecord($data);
		$memberAccount = $this->getMemberAccount($data['member_id']);
		if ($memberAccount->balance < $data['amount']){
			throw new ValidateException(lang('balance_not_enough'));
		}
		$memberAccount->balance -= $data['amount'];
		$memberAccount->withdraw_balance += $data['amount'];
		$memberAccount->save();
		MemberAccountRecord::create([
			'relation_id'   => $data['relation_id'],
			'member_id'     => $data['member_id'],
			'trade_type'    => self::TRADE_OUT,
			'trans_type'    => $data['trans_type'],
			'amount'        => $data['amount'],
			'balance'       => $memberAccount->balance,
			'create_time' => time(),
		]);
	}

    /**
     * 验证账户记录数据
     * @param array $data
     * @return void
     */
    private function validateMemberAccountRecord(array $data = []){
        validate(\app\common\validate\MemberAccountRecord::class)->check($data);
    }

    /**
     * 返佣 现货 期货，机构买入执行返佣
     * @param $memberId
     * @param int $relationId
     * @param string $transType //交易类型
     * @param float $amount
     * @return bool
     * @throws DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function commission($memberId, int $relationId = 0, string $transType = 'commission', float $amount = 0.00): bool
    {
        $member = Member::find($memberId);
        $memberAccount = $this->getMemberAccount($memberId);
        // 交易数据
        $recordData = [
            'relation_id'   => $relationId,
            'account_type'  => $this->accountType,
            'trans_type'    => $transType
        ];
        // 获取返佣比例
        $config = Config::where(['group' => 'account'])->column('value','name');
        if ($member->parent_id > 0){
            $commissionProp = $config['commission_one']; // 返佣比例
            if ($commissionProp > 0){
                $recordData['member_id'] = $member->parent_id;
                $recordData['amount']    = $amount * $commissionProp;
//	            $recordData['profit']    = $amount;
//	            $recordData['ratio']     = $commissionProp;
//                $this->income($recordData, 'commission1');
                // 增加佣金返至余额中
                $this->income($recordData);
                $memberAccount->pay_commission = bcadd((string)$memberAccount->pay_commission,(string)$recordData['amount']);
            }
        }
        if ($member->grand_id > 0){
            $commissionProp = $config['commission_second']; // 返佣比例
            if ($commissionProp > 0){
                $recordData['member_id'] = $member->grand_id;
                $recordData['amount']    = $amount * $commissionProp;
//                $this->income($recordData, 'commission2');
                $this->income($recordData);
                $memberAccount->pay_commission = bcadd((string)$memberAccount->pay_commission,(string)$recordData['amount']);
            }
        }
        // 三级返佣
        if ($member->top_id > 0){
            $commissionProp = $config['commission_three']; // 返佣比例
            if ($commissionProp > 0){
                $recordData['member_id'] = $member->top_id;
                $recordData['amount']    = $amount * $commissionProp;
//                $this->income($recordData, 'commission3');
                $this->income($recordData);
                $memberAccount->pay_commission = bcadd((string)$memberAccount->pay_commission,(string)$recordData['amount']);
            }
        }

        $memberAccount->save();

        return true;

    }

    protected function validateError(string $error){
        throw new ValidateException($error);
    }


}