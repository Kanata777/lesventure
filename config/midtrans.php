<?php

return [
    'serverKey'     => env('MIDTRANS_SERVER_KEY'),
    'clientKey'     => env('MIDTRANS_CLIENT_KEY'),
    'isProduction'  => false, // true jika sudah live
    'isSanitized'   => true,
    'is3ds'         => true,
];
