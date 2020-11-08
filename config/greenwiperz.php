<?php

return [
    'company' => [
        'name' => env('GW_NAME', 'Greenwiperz by Bansagi'),
        'street' => env('GW_STREET', 'Grindelstrasse 41D'),
        'postal_code' => env('GW_POSTAL_CODE', '8604'),
        'city' => env('GW_CITY', 'Volketswil'),
        'country' => env('GW_COUNTRY', 'Schweiz'),
        'telefon' => env('GW_TELEFON', '+41 76 266 12 83'),
        'email'=> env('GW_EMAIL', 'info@greenwiperz.ch'),
        'web' => env('GW_WEB', 'www.greenwiperz.ch'),
        'mwst_id' => env('GW_MWST_ID', 'CHE-123.123.123'),        
        'dirty_surcharge' => env('GW_SURCHARGE', '3000'),
    ],
    'mwst_percent' => env('MWST_PERCENT', '0.077'),

];
