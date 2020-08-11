<?php
use modava\faq\FaqModule;

return [
    'availableLocales' => [
        'vi' => 'Tiếng Việt',
        'en' => 'English',
        'jp' => 'Japan',
    ],
    'faqName' => 'Faq',
    'faqVersion' => '1.0',
    'status' => [
        '0' => FaqModule::t('faq', 'Tạm ngưng'),
        '1' => FaqModule::t('faq', 'Hiển thị'),
    ]
];
