<?php
use modava\faq\FaqModule;

return [
    'faqName' => 'Faq',
    'faqVersion' => '1.0',
    'status' => [
        '0' => FaqModule::t('faq', 'Tạm ngưng'),
        '1' => FaqModule::t('faq', 'Hiển thị'),
    ]
];
