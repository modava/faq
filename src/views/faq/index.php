<?php

use modava\auth\models\User;
use modava\faq\FaqModule;
use modava\faq\widgets\JsUtils;
use modava\faq\widgets\NavbarWidgets;
use yii\helpers\Html;
use backend\widgets\ToastrWidget;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel modava\faq\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = FaqModule::t('faq', 'Faqs');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $searchModel->toastr_key . '-index']) ?>
    <div class="container-fluid px-xxl-25 px-xl-10">
        <?= NavbarWidgets::widget(); ?>

        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                            class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
            </h4>
            <button class="btn btn-outline-light" type="button" onclick="openCreateModal({model: 'Faq',
    });"
                    title="<?= FaqModule::t('faq', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= FaqModule::t('faq', 'Create Question'); ?></button>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">

                <?php Pjax::begin(); ?>
                <?php echo $this->render('_search', ['model' => $searchModel]) ?>
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="table-wrap">
                                <div class="dataTables_wrapper dt-bootstrap4 table-responsive px-4">
                                    <?= ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'summary' => FaqModule::t('faq', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.'),
                                        'summaryOptions' => [
                                            'class' => 'mb-4'
                                        ],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                            $buttonAnswer = '';
                                            $buttonDelete = '';

                                            if (Yii::$app->user->can('faqFaqAnswer') || Yii::$app->user->can(User::DEV) || Yii::$app->user->can('admin')) {
                                                if ($model->content) {
                                                    $message = FaqModule::t('faq', 'Update Answer');
                                                } else {
                                                    $message = FaqModule::t('faq', 'Answer the Question');
                                                }

                                                $buttonAnswer = Html::button($message,
                                                    [
                                                        'class' => 'btn btn-sm float-right btn-link',
                                                        'onclick' => 'openUpdateModal({model: "Faq", id: ' . $model->primaryKey . '})'
                                                    ]);
                                            }

                                            if (Yii::$app->user->can('faqFaqDelete') || Yii::$app->user->can(User::DEV) || Yii::$app->user->can('admin')) {
                                                $buttonDelete = Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:;', [
                                                    'title' => FaqModule::t('affiliate', 'Delete'),
                                                    'class' => 'btn btn-link btn-xs btn-del float-right text-danger',
                                                    'data-title' => FaqModule::t('affiliate', 'Delete?'),
                                                    'data-pjax' => 0,
                                                    'data-url' => Url::toRoute(['delete', 'id' => $model->primaryKey]),
                                                    'btn-success-class' => 'success-delete',
                                                    'btn-cancel-class' => 'cancel-delete',
                                                    'data-placement' => 'top'
                                                ]);
                                            }

                                            return "
                                             <div class='mb-4'>
                                                <h5 class='py-1'><a href='javascript:openDetailViewModal({model: \"Faq\", id: {$model->primaryKey}})'>{$model->title}</a></h5>
                                                <p>{$model->short_content} {$buttonDelete} {$buttonAnswer}</p>
                                                <p>{$model->faqCategory->title}</p>
                                            </div>
                                            
                                        ";
                                        },
                                        'pager' => [
                                            'firstPageLabel' => FaqModule::t('affiliate', 'First'),
                                            'lastPageLabel' => FaqModule::t('affiliate', 'Last'),
                                            'prevPageLabel' => FaqModule::t('affiliate', 'Previous'),
                                            'nextPageLabel' => FaqModule::t('affiliate', 'Next'),
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