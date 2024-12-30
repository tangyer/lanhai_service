<?php

return [
    'login' => [
        'success'                               => 'login bem sucedido',
        'account_not_exist'                     => 'conta não existe',
        'wrong_password'                        => 'senha incorreta',
        'email_already_exist'                   => 'e-mail já existe',
        'email_send_error'                      => 'Falha no envio de e-mail',
        'mobile_already_exist'                  => 'O número de telefone já existe',
        'mobile_send_error'                     => 'Falha ao enviar o código de verificação móvel',
        'auth_code_error'                       => 'Erro no código de verificação',
        'data_already_exists'                   => 'dados já existem',
        'username_exists'                       => 'O nome de usuário já existe',
        'mobile_exists'                         => 'O número de telefone já existe',
        'invite_code_error'                     => 'Erro no código do convite',
        'logout_successful'                     => 'sair com sucesso',
    ],
    'reg'                                       => [
        'password_error'                        => 'senha deve ter 6 16 letras mais números',
        'username_min_error'                    => 'O nome de utilizador não deve ser inferior a 5 caracteres'
    ],
    'change' => [
        'success'                               => 'Modificado com sucesso',
        'account_not_exist'                     => 'conta não existe',
        'wrong_password'                        => 'senha incorreta',
    ],
    'cash_min'                                  => 'O valor mínimo de saque é{:amount}',
    'withdrawal_num_day'                        => 'O número de saques diários atingiu o limite',
    'trade_password_error'                      => 'senha de transação errada',
    'level_low'                                 => 'nível muito baixo',
    'balance_zero'                              => 'Saldo insuficiente',
    'not_started'                               => 'não começou',
    'not_exist'                                 => 'Produto não existe',
    'contact_customer_service'                  => 'Entre em contato com o atendimento ao cliente',
    'not_match'                                 => 'Nota e ordem não coincidem',
    'submit_fail'                               => 'Falha no envio',
    'order_none_or_invalid'                     => 'Nenhum pedido ou cancelado',
    'password_incorrect'                        => 'A senha está incorreta',
    'order_payed'                               => 'pedido pago',
    'insufficient_funds'                        => 'Fundos insuficientes, precisa recarregar: {:amount}',
    'proceed_order'                             => 'Por favor, faça isso em ordem',
    'recharge_error'                            => 'erro de recarga',
    'order_error'                               => 'Erro de ordem',
    'hash_is_null'                              => 'Hash é nulo',
    'order_completion_prompt'                   => 'Parabéns, você completou {:amount} pedidos',
    'withdraw'                                  => [
        'amount_require'                        => 'montante necessário',
    ],
    'recharge'                                  => [
        'amount_require'                        => 'montante necessário',
        'pay_type'                              => 'tipo de pagamento exigido',
        'amount_min_error'                      => 'Quantidade mínima de recarga {:amount}'
    ],
    'order'                                     => [
        'freeze_contact_customer'               => 'O pedido foi congelado, entre em contato com o serviço de atendimento ao cliente'
    ],



];