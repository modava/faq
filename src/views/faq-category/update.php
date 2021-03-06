<?php

use modava\faq\widgets\NavbarWidgets;
use yii\helpers\Html;
use yii\helpers\Url;
use modava\faq\FaqModule;

/* @var $this yii\web\View */
/* @var $model modava\faq\models\FaqCategory */

$this->title = Yii::t('backend', 'Update : {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Faq Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
        </h4>
        <a class="btn btn-outline-light" href="<?= Url::to(['create']); ?>"
           title="<?= Yii::t('backend', 'Create'); ?>">
            <i class="fa fa-plus"></i> <?= Yii::t('backend', 'Create'); ?></a>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </section>
        </div>
    </div>
</div>
