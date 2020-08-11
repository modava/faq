<?php

use modava\faq\FaqModule;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        'slug',
        'content:raw',
        'short_content:raw',
        'status',
        [
            'attribute' => 'faq_category_id',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->faqCategory->title, Url::toRoute(['faq-category/view', 'id' => $model->faq_category_id]));
            }
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function ($model) {
                return Yii::$app->controller->module->params['status'][$model->status];
            }
        ],
        'created_at:datetime',
        'updated_at:datetime',
        [
            'attribute' => 'userCreated.userProfile.fullname',
            'label' => FaqModule::t('faq', 'Created By')
        ],
        [
            'attribute' => 'userUpdated.userProfile.fullname',
            'label' => FaqModule::t('faq', 'Updated By')
        ],
    ],
]) ?>