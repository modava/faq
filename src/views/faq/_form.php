<?php

use modava\auth\models\User;
use modava\faq\widgets\JsCreateModalWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\faq\FaqModule;

/* @var $this yii\web\View */
/* @var $model modava\faq\models\Faq */
/* @var $form yii\widgets\ActiveForm */

if (in_array(Yii::$app->controller->action->id, ['create', 'get-create-modal'])) {
    $model->status = 1;
}

?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="faq-category-form">
    <?php $form = ActiveForm::begin([
        'id' => 'faq_form',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute(['/faq/faq/validate', 'id' => $model->primaryKey]),
    ]); ?>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label(FaqModule::t('faq',
                'Question')) ?>
        </div>

        <?php if (Yii::$app->user->can(User::DEV) || Yii::$app->user->can('admin') || Yii::$app->user->can('faqFaqUpdate-active')): ?>
            <div class="col-6">
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
        <?php else: ?>
            <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
        <?php endif; ?>

        <div class="col-6">
            <?= $form->field($model, 'faq_category_id')->dropDownList(
                ArrayHelper::map(\modava\faq\models\table\FaqCategoryTable::getAllRecordsPublished(), 'id', 'title'),
                ['prompt' => FaqModule::t('faq', 'Select an option ...')]
            ) ?>
        </div>
        <?php if (Yii::$app->user->can('faqFaqAnswer') || Yii::$app->user->can(User::DEV)): ?>
            <div class="col-12">
                <?= $form->field($model, 'short_content')->widget(\modava\tiny\TinyMce::class, [
                    'options' => ['rows' => 6],
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'content')->widget(\modava\tiny\TinyMce::class, [
                    'options' => ['rows' => 20],
                    'type' => 'content'
                ])->label(FaqModule::t('faq', 'Answer')) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(FaqModule::t('faq', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?= JsCreateModalWidget::widget(['formClassName' => 'faq_form', 'modelName' => 'Faq']) ?>
