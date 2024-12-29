<?php

return [
    'login' => [
        'success'                           => 'Авторизация успешна',
        'account_not_exist'                 => 'Аккаунт не существует',
        'wrong_password'                    => 'неправильный пароль',
        'email_already_exist'               => 'Эл. адрес уже существует',
        'email_send_error'                  => 'Отправка электронной почты не удалась',
        'mobile_already_exist'              => 'Номер телефона уже существует',
        'mobile_send_error'                 => 'Не удалось отправить мобильный код подтверждения',
        'auth_code_error'                   => 'Ошибка кода подтверждения',
        'data_already_exists'               => 'данные уже существуют',
        'username_exists'                   => 'Имя пользователя уже занято',
        'mobile_exists'                     => 'Номер телефона уже существует',
        'invite_code_error'                 => 'Ошибка кода приглашения',
        'logout_successful'                 => 'выйти успешно',
    ],
    'reg'                                   => [
        'password_error'                    => 'пароль должен иметь длину 6 16 букв плюс цифры',
        'username_min_error'                => 'имя пользователя должно быть не менее 5 символовs'
    ],
    'change' => [
        'success'                           => 'Успешно изменено',
        'account_not_exist'                 => 'Аккаунт не существует',
        'wrong_password'                    => 'Неправильный пароль',
    ],
    'cash_min'                              => 'Минимальная сумма вывода: {:amount}',
    'withdrawal_num_day'                    => 'Количество ежедневных выводов средств достигло предела',
    'trade_password_error'                  => 'торговый пароль неверный',
    'level_low'                             => 'Уровень слишком низкий',
    'balance_zero'                          => 'Недостаточный баланс',
    'not_started'                           => 'Не начался',
    'not_exist'                             => 'Продукт не существует',
    'contact_customer_service'              => 'Пожалуйста, свяжитесь со службой поддержки',
    'not_match'                             => 'Класс и порядок не совпадают',
    'submit_fail'                           => 'Отправить не удалось',
    'order_none_or_invalid'                  => 'Нет заказа или отменен',
    'password_incorrect'                    => 'неверный пароль',
    'order_payed'                           => 'Заказ оплачен',
    'insufficient_funds'                    => 'Недостаточно средств, необходимо пополнить: {:amount}',
    'proceed_order'                         => 'Пожалуйста, действуйте по порядку',
    'recharge_error'                        => 'Ошибка перезарядки',
    'order_error'                           => 'Ошибка заказа',
    'hash_is_null'                          => 'Хэш равен нулю',
    'order_completion_prompt'               => 'Поздравляем, вы выполнили {:amount} заказов',
    'withdraw'                              => [
        'amount_require'                    => 'требуемая сумма',
    ],
    'recharge'                              => [
        'amount_require'                    => 'требуемая сумма',
        'pay_type'                          => 'тип оплаты требуется',
        'amount_min_error'                  => 'Минимальная сумма пополнения {:amount}',
    ],
    'order'                                 => [
        'freeze_contact_customer'           => 'Заказ заморожен, обратитесь в службу поддержки',
    ],

];