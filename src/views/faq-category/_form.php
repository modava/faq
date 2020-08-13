<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\faq\FaqModule;

/* @var $this yii\web\View */
/* @var $model modava\faq\models\FaqCategory */
/* @var $form yii\widgets\ActiveForm */

if (Yii::$app->controller->action->id === 'create') $model->status = 1;

?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="faq-category-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'description')->widget(\modava\tiny\TinyMce::class, [
                'options' => ['rows' => 6],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(FaqModule::t('faq', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
