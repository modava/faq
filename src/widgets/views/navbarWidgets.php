<?php

use yii\helpers\Url;

// Define route info
$routeInfos = [
    [
        'module' => 'faq',
        'controllerId' => 'faq',
        'model' => 'Faq',
        'label' => Yii::t('backend', 'Faq'),
        'icon' => '<i class="ion ion-md-contacts"></i>',
    ],
    [
        'module' => 'faq',
        'controllerId' => 'faq-category',
        'model' => 'FaqCategory',
        'label' => Yii::t('backend', 'Faq Category'),
        'icon' => '<i class="ion ion-md-contacts"></i>',
    ],
];
?>
<ul class="nav nav-tabs nav-sm nav-light mb-10">
    <?php foreach ($routeInfos as $routeInfo): ?>
        <li class="nav-item mb-5">
            <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == $routeInfo['controllerId']) echo ' active' ?>"
               href="<?= Url::toRoute(["/{$routeInfo['module']}/{$routeInfo['controllerId']}"]); ?>">
                <?= $routeInfo['icon'] . Yii::t('backend', $routeInfo['label']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
