<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modava\faq\FaqModule;

/* @var $this yii\web\View */
/* @var $model modava\faq\models\search\FaqCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'publish') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(FaqModule::t('faq', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(FaqModule::t('faq', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
