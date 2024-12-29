<?php

return [
	'login' => [
        'success'                           => 'login successful',
        'account_not_exist'                 => 'Account does not exist',
        'wrong_password'                    => 'wrong password',
        'email_already_exist'               => 'Email already exists',
        'email_send_error'                  => 'Email sending failed',
        'mobile_already_exist'              => 'Phone number already exists',
        'mobile_send_error'                 => 'Failed to send mobile verification code',
        'auth_code_error'                   => 'Verification code error',
        'data_already_exists'               => 'data already exists',
        'username_exists'                   => 'Username already exists',
        'mobile_exists'                     => 'Phone number already exists',
        'invite_code_error'                 => 'Invitation code error',
        'logout_successful'                 => 'exit successfully',
	],
    'reg'                                   => [
        'password_error'                    => 'password must length 6 16 letters plus numbers',
        'username_min_error'                => 'username shall not be less than 5 characters'
    ],
    'change' => [
        'success'                           => 'Successfully modified',
        'account_not_exist'                 => 'Account does not exist',
        'wrong_password'                    => 'Wrong password',
    ],
    'cash_min'                              => 'The minimum withdrawal amount is{:amount}',
    'withdrawal_num_day'                    => 'The number of daily withdrawals has reached the limit',
    'trade_password_error'                  => 'trade password incorrect',
    'level_low'                             => 'The level is too low',
    'balance_zero'                          => 'Insufficient balance',
    'not_started'                           => 'Not Started',
    'not_exist'                             => 'Product does not exist',
    'contact_customer_service'              => 'Please contact customer service',
    'not_match'                             => 'Grade and order do not match',
    'submit_fail'                           => 'Submit fail',
    'order_none_or_invalid'                  => 'No order or cancelled',
    'password_incorrect'                    => 'Incorrect password',
    'order_payed'                           => 'Order paid',
    'insufficient_funds'                    => 'Insufficient funds, need to recharge: {:amount}',
    'proceed_order'                         => 'please proceed in order',
    'recharge_error'                        => 'Recharging error',
    'order_error'                           => 'Order error',
    'hash_is_null'                          => 'Hash is null',
    'order_completion_prompt'               => 'Congratulations, you have completed {:amount} orders',
    'withdraw'                              => [
        'amount_require'                    => 'amount require',
    ],
    'recharge'                              => [
        'amount_require'                    => 'amount require',
        'pay_type'                          => 'pay type require',
        'amount_min_error'                  => 'Minimum recharge amount {:amount}',
    ],
    'order'                                 => [
        'freeze_contact_customer'           => 'The order has been frozen, please contact customer service',
    ],
    'upload_success'                        => 'Upload Successfully'

];