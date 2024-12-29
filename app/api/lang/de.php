<?php

return [
	'login' => [
        'success'                               => 'Anmeldung erfolgreich',
		'account_not_exist'                     => 'Konto existiert nicht',
		'wrong_password'                        => 'falsches Passwort',
        'email_already_exist'                   => 'E-Mail ist bereits vorhanden',
        'email_send_error'                      => 'E-Mail-Versand fehlgeschlagen',
        'mobile_already_exist'                  => 'Telefonnummer existiert bereits',
        'mobile_send_error'                     => 'Mobiler Bestätigungscode konnte nicht gesendet werden',
        'auth_code_error'                       => 'Bestätigungscode-Fehler',
        'data_already_exists'                   => 'Daten sind bereits vorhanden',
        'username_exists'                       => 'Benutzername existiert bereits',
        'mobile_exists'                         => 'Telefonnummer existiert bereits',
        'invite_code_error'                     => 'Einladungscode-Fehler',
        'logout_successful'                     => 'erfolgreich beenden',
	],
    'change' => [
        'success'                               => 'Erfolgreich geändert',
        'account_not_exist'                     => 'Konto existiert nicht',
        'wrong_password'                        => 'falsches Passwort'
    ],
    'cash_min'                                  => 'Der Mindestauszahlungsbetrag beträgt{:amount}',
    'withdrawal_num_day'                        => 'Die Anzahl der täglichen Abhebungen hat das Limit erreicht',
    'trade_password_error'                      => 'falsches Transaktionspasswort',
    'level_low'                                 => 'Der Pegel ist zu niedrig',
    'balance_zero'                              => 'Mangelhaftes Gleichgewicht',
    'not_started'                               => 'Nicht gestartet',
    'not_exist'                                 => 'Produkt existiert nicht',
    'contact_customer_service'                  => 'Bitte kontaktieren Sie den Kundenservice',
    'not_match'                                 => 'Grad und Reihenfolge stimmen nicht überein',
    'submit_fail'                               => 'Absenden fehlgeschlagen',
    'order_none_or_vilied'                      => 'Keine Bestellung oder storniert',
    'password_incorrect'                        => 'Falsches Passwort',
    'order_payed'                               => 'Zahlung der Bestellung',
    'insufficient_funds'                        => 'Unzureichendes Guthaben, Aufladen erforderlich: {:amount}',
    'proceed_order'                             => 'Bitte fahren Sie fort, um',
    'recharge_error'                            => 'Fehler beim Aufladen',
    'order_error'                               => 'Bestellfehler',
    'hash_is_null'                              => 'Hash ist null',
    'order_completion_prompt'                   => 'Herzlichen Glückwunsch, Sie haben {:amount} Bestellungen abgeschlossen',
    'withdraw'                              => [
        'amount_require'                    => 'Benötigte Menge',
    ],
    'recharge'                              => [
        'amount_require'                    => 'Benötigte Menge',
        'pay_type'                          => 'Anforderungen an die Zahlungsart',
        'amount_min_error'                  => 'Mindestaufladebetrag{:amount}',
    ],
    'order'                                 => [
        'freeze_contact_customer'           => 'Die Bestellung wurde eingefroren. Bitte wenden Sie sich an den Kundendienst',
    ],
];