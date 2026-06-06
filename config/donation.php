<?php

return [
    'payment_methods' => [
        'usdt' => [
            'name' => 'USDT (TRC20)',
            'address' => 'عنوان محفظتك هنا',
            'network' => 'TRC20',
        ],
        'bank_transfer' => [
            'name' => 'حوالة بنكية',
            'iban' => 'رقم الآيبان هنا',
            'bank_name' => 'اسم البنك',
            'account_name' => 'اسم المستفيد',
        ],
    ],
    'donation_types' => [
        'sustainable' => 'مشاريع مستدامة',
        'relief' => 'إغاثية',
        'orphans' => 'رعاية الأيتام',
        'health' => 'صحية',
    ],
];
