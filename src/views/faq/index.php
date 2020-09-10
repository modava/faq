<?php

use backend\widgets\ToastrWidget;
use modava\auth\models\User;
use modava\faq\widgets\JsUtils;
use modava\faq\widgets\NavbarWidgets;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modava\faq\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Faqs');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss('   
.hk-sec-wrapper {
    padding: 1rem;
}
');
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $searchModel->toastr_key . '-index']) ?>
    <div class="container-fluid px-xxl-25 px-xl-10">
        <?= NavbarWidgets::widget(); ?>

        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                            class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
            </h4>
            <button class="btn btn-outline-light btn-sm" type="button"
                    onclick="openCreateModal({model: 'Faq'});"
                    title="<?= Yii::t('backend', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= Yii::t('backend', 'Create Question'); ?></button>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">

                <?php Pjax::begin(); ?>
                <?php echo $this->render('_search', ['model' => $searchModel]) ?>
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-xl-12">
                            <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => '<div class="summary mb-4">{summary}</div>{items}',
                                'summary' => Yii::t('backend', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.'),
                                'itemView' => function ($model, $key, $index, $widget) {
                                    $buttonAnswer = '';
                                    $buttonDelete = '';
                                    $class = '';

                                    if (Yii::$app->user->can('faqFaqAnswer') || Yii::$app->user->can(User::DEV) || Yii::$app->user->can('admin')) {
                                        if ($model->content) {
                                            $message = Yii::t('backend', 'Update Answer');
                                            $class = 'text-info';
                                        } else {
                                            $message = Yii::t('backend', 'Answer the Question');
                                        }

                                        $buttonAnswer = Html::button($message,
                                            [
                                                'class' => "btn btn-sm float-right btn-link {$class}",
                                                'onclick' => 'openUpdateModal({model: "Faq", id: ' . $model->primaryKey . '})'
                                            ]);
                                    }
                                    if (Yii::$app->user->can('faqFaqDelete') || Yii::$app->user->can(User::DEV) || Yii::$app->user->can('admin')) {
                                        $buttonDelete = Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:;', [
                                            'title' => Yii::t('backend', 'Delete'),
                                            'class' => 'btn btn-link btn-xs btn-del float-right text-danger',
                                            'data-title' => Yii::t('backend', 'Delete?'),
                                            'data-pjax' => 0,
                                            'data-url' => Url::toRoute(['delete', 'id' => $model->primaryKey]),
                                            'btn-success-class' => 'success-delete',
                                            'btn-cancel-class' => 'cancel-delete',
                                            'data-placement' => 'top'
                                        ]);
                                    }

                                    return "
                                             <div class='mb-4'>
                                                <div class='category'><i class='ion ion-md-remove'></i> {$model->faqCategory->title}</div>
                                                <h5 class='py-1'><a href='javascript:openDetailViewModal({model: \"Faq\", id: {$model->primaryKey}})'>{$model->title}</a></h5>
                                                <p>{$model->short_content} {$buttonDelete} {$buttonAnswer}</p>
                                            </div>
                                            
                                        ";
                                },
                                'pager' => [
                                    'firstPageLabel' => Yii::t('backend', 'First'),
                                    'lastPageLabel' => Yii::t('backend', 'Last'),
                                    'prevPageLabel' => Yii::t('backend', 'Previous'),
                                    'nextPageLabel' => Yii::t('backend', 'Next'),
                                    'maxButtonCount' => 5,

                                    'options' => [
                                        'tag' => 'ul',
                                        'class' => 'pagination',
                                    ],

                                    // Customzing CSS class for pager link
                                    'linkOptions' => ['class' => 'page-link'],
                                    'activePageCssClass' => 'active',
                                    'disabledPageCssClass' => 'disabled page-disabled',
                                    'pageCssClass' => 'page-item',

                                    // Customzing CSS class for navigating link
                                    'prevPageCssClass' => 'paginate_button page-item',
                                    'nextPageCssClass' => 'paginate_button page-item',
                                    'firstPageCssClass' => 'paginate_button page-item',
                                    'lastPageCssClass' => 'paginate_button page-item',
                                ],
                            ]); ?>
                        </div>
                    </div>
                </section>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>

<?= JsUtils::widget() ?>

<?php
$script = <<< JS
$('body').on('click', '.success-delete', function(e){
    e.preventDefault();
    var url = $(this).attr('href') || null;
    if(url !== null){
        $.post(url);
    }
    return false;
}).on('post-object-created', function() {
    $('#faqsearch-title').val('');
    $('#search_faq').trigger('click');
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);