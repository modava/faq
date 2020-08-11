<?php

use modava\faq\FaqModule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modava\faq\models\search\FaqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'title', [
                'template' => '
                <div class="input-group mb-3">
                    {input}
                    <div class="input-group-append">
                      ' . Html::submitButton(FaqModule::t('faq', 'Search'), ['class' => 'btn btn-success', 'id' => 'search_faq']) . '
                    </div>
                 </div>'
            ])->input('text', ['placeholder' => FaqModule::t('faq', 'Place a question...'),])->label(false) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
