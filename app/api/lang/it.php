<?php

return [
    'login' => [
        'success'                           => "accesso riuscito",
        'account_not_exist'                 => "l'account non esiste",
        'wrong_password'                    => "password errata",
        'email_already_exist'               => "Email già esistente",
        'email_send_error'                  => "Invio email non riuscito",
        'mobile_already_exist'              => "Il numero di telefono esiste già",
        'mobile_send_error'                 => "Impossibile inviare il codice di verifica mobile",
        'auth_code_error'                   => "Errore codice di verifica",
        'data_already_exists'               => "i dati esistono già",
        'username_exists'                   => "Il nome utente esiste già",
        'mobile_exists'                     => "Il numero di telefono esiste già",
        'invite_code_error'                 => "Errore codice invito",
        'logout_successful'                 => "uscire con successo",
    ],
    'reg'                                   => [
        'password_error'                    => "la password deve essere lunga 6 16 lettere più numeri",
        'username_min_error'                => "il nome utente non deve essere inferiore a 5 caratteri",
    ],
    'change' => [
        'success'                           => "Modificato con successo",
        'account_not_exist'                 => "l'account non esiste",
        'wrong_password'                    => "Password errata",
    ],
    'cash_min'                              => "L'importo minimo di prelievo è {:amount}",
    'withdrawal_num_day'                    => 'Il numero di prelievi giornalieri ha raggiunto il limite',
    'trade_password_error'                  => "password commerciale errata",
    'level_low'                             => "Il livello è troppo basso",
    'balance_zero'                          => "Equilibrio insufficiente",
    'not_started'                           => "Non iniziato",
    'not_exist'                             => "Il prodotto non esiste",
    'contact_customer_service'              => "Si prega di contattare il servizio clienti",
    'not_match'                             => "Grado e ordine non corrispondono",
    'submit_fail'                           => "Invio fallito",
    'order_none_or_invalid'                  => "Nessun ordine o annullato",
    'password_incorrect'                    => "password errata",
    'order_payed'                           => "Ordine pagato",
    'insufficient_funds'                    => "Fondi insufficienti, è necessario ricaricare: {:amount}",
    'proceed_order'                         => "Si prega di procedere con ordine",
    'recharge_error'                        => "Errore di ricarica",
    'order_error'                           => "Errore nell'ordine",
    'hash_is_null'                          => "L'hash è nullo",
    'order_completion_prompt'               => 'Congratulazioni, hai completato {:amount} ordini',
    'withdraw'                              => [
        'amount_require'                    => "importo richiesto",
    ],
    'recharge'                              => [
        'amount_require'                    => "importo richiesto",
        'pay_type'                          => "tipo di pagamento richiesto",
        'amount_min_error'                  => "Importo minimo di ricarica {:amount}",
    ],
    'order'                                 => [
        'freeze_contact_customer'           => "L'ordine è stato congelato, contatta il servizio clienti",
    ],

];

