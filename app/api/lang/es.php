<?php

return [
    'login' => [
        'success'                               => 'Inicio de sesión correcto',
        'account_not_exist'                     => 'La cuenta no existe',
        'wrong_password'                        => 'contraseña incorrecta',
        'email_already_exist'                   => 'el Email ya existe',
        'email_send_error'                      => 'Envío de correo electrónico fallido',
        'mobile_already_exist'                  => 'El número de teléfono ya existe',
        'mobile_send_error'                     => 'Error al enviar el código de verificación móvil',
        'auth_code_error'                       => 'Error de código de verificación',
        'data_already_exists'                   => 'los datos ya existen',
        'username_exists'                       => 'nombre de usuario ya existe',
        'mobile_exists'                         => 'El número de teléfono ya existe',
        'invite_code_error'                     => 'Error de código de invitación',
        'logout_successful'                     => 'salir con éxito',
    ],
    'reg'                                       => [
        'password_error'                        => 'La longitud de la contraseña debe ser de 6 16 letras más un número',
        'username_min_error'                    => 'El nombre de usuario no debe ser inferior a 5 dígitos',
    ],
    'change' => [
        'success'                               => 'Modificado con éxito',
        'account_not_exist'                     => 'La cuenta no existe',
        'wrong_password'                        => 'contraseña incorrecta',
    ],
    'cash_min'                                  => 'El monto mínimo de retiro es{:amount}',
    'withdrawal_num_day'                        => 'El número de retiros diarios ha alcanzado el límite',
    'trade_password_error'                      => 'contraseña de transacción incorrecta',
    'level_low'                                 => 'nivel demasiado bajo',
    'balance_zero'                              => 'Saldo insuficiente',
    'not_started'                               => 'no ha comenzado',
    'not_exist'                                 => 'El producto no existe',
    'contact_customer_service'                  => 'Por favor, póngase en contacto con el servicio de atención al cliente.',
    'not_match'                                 => 'El grado y el orden no coinciden',
    'submit_fail'                               => 'Envío fallido',
    'order_none_or_invalid'                     => 'Sin pedido o cancelado',
    'password_incorrect'                        => 'La contraseña es incorrecta',
    'order_payed'                               => 'orden pagada',
    'insufficient_funds'                        => 'Fondos insuficientes, necesita recargar: {:cantidad}',
    'proceed_order'                             => 'por favor hazlo en orden',
    'recharge_error'                            => 'error de recarga',
    'order_error'                               => 'Error de orden',
    'hash_is_null'                              => 'hash es nulo',
    'order_completion_prompt'                   => 'Felicitaciones, ha completado {:amount} pedidos',
    'withdraw'                                  => [
          'amount_require'                      => 'Cantidad necesaria',
    ],
    'recharge'                                  => [
        'amount_require'                        => 'Cantidad necesaria',
        'pay_type'                              => 'Requisitos del tipo de pago',
        'amount_min_error'                      => 'Importe mínimo de recarga {:amount}'
    ],
    'order'                                     => [
        'freeze_contact_customer'               => 'Pedido congelado, por favor póngase en contacto con el servicio al cliente',
    ],





];