<?php

return [
	'login' => [
        'success'                           => 'login berhasil',
        'account_not_exist'                 => 'akun tidak ada',
        'wrong_password'                    => 'kata sandi salah',
        'email_already_exist'               => 'Email sudah ada',
        'email_send_error'                  => 'Pengiriman email gagal',
        'mobile_already_exist'              => 'Nomor telepon sudah ada',
        'mobile_send_error'                 => 'Gagal mengirim kode verifikasi seluler',
        'auth_code_error'                   => 'Kesalahan kode verifikasi',
        'data_already_exists'               => 'data sudah ada',
        'username_exists'                   => 'Nama pengguna sudah ada',
        'mobile_exists'                     => 'Nomor telepon sudah ada',
        'invite_code_error'                 => 'Kesalahan kode undangan',
        'logout_successful'                 => 'keluar dengan sukses',
	],
    'reg'                                   => [
        'password_error'                    => 'kata sandi harus panjang 6 16 huruf ditambah angka',
        'username_min_error'                => 'Nama pengguna tidak boleh kurang dari 5 karakter'
    ],
    'change' => [
        'success'                           => 'Berhasil dimodifikasi',
        'account_not_exist'                 => 'akun tidak ada',
        'wrong_password'                    => 'Kata sandi salah',
    ],
    'cash_min'                              => 'Jumlah penarikan minimum adalah{:amount}',
    'withdrawal_num_day'                    => 'Jumlah penarikan harian telah mencapai batas',
    'trade_password_error'                  => 'sandi perdagangan salah',
    'level_low'                             => 'Levelnya terlalu rendah',
    'balance_zero'                          => 'Saldo tidak mencukupi',
    'not_started'                           => 'Belum mulai',
    'not_exist'                             => 'Produk tidak ada',
    'contact_customer_service'              => 'Silakan hubungi layanan pelanggan',
    'not_match'                             => 'Grade dan pesanan tidak cocok',
    'submit_fail'                           => 'Kirim gagal',
    'order_none_or_invalid'                  => 'Tidak ada pesanan atau dibatalkan',
    'password_incorrect'                    => 'kata kunci Salah',
    'order_payed'                           => 'Pesanan dibayar',
    'insufficient_funds'                    => 'Dana tidak mencukupi, perlu diisi ulang: {:amount}',
    'proceed_order'                         => 'Silakan lanjutkan secara berurutan',
    'recharge_error'                        => 'Pengisian ulang kesalahan',
    'order_error'                           => 'Kesalahan pemesanan',
    'hash_is_null'                          => 'Hash adalah nol',
    'order_completion_prompt'               => 'Selamat, Anda telah menyelesaikan pesanan {:mount}',
    'withdraw'                              => [
        'amount_require'                    => 'jumlah yang dibutuhkan',
    ],
    'recharge'                                  => [
        'amount_require'                        => 'jumlah yang dibutuhkan',
        'pay_type'                              => 'tipe gaji yang diperlukan',
        'amount_min_error'                      => 'Jumlah muat ulang minimal {:amount}'
    ],
    'order'                                 => [
        'freeze_contact_customer'           => 'Pesanan telah dibekukan, silakan hubungi layanan pelanggan'
    ],

];