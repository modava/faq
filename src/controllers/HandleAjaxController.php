<?php

namespace modava\faq\controllers;

use modava\faq\FaqModule;
use modava\faq\components\MyFaqController;
use modava\faq\helpers\Utils;
use Yii;
use yii\web\Response;

/*
 * Implement by Duc Huynh
 * Date: 2020-07-29
 * Purpose: Provide a controller handle ajax request
 * */

class HandleAjaxController extends MyFaqController
{
    var $modelName = null;
    var $classModelName = null;
    var $classModelNameTable = null;
    var $classModelNameSearch = null;
    var $toastr_key = 'handle-ajax';

    /*public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['*']
            ],
        ];
    }*/

    public function actionGetCreateModal()
    {
        $formView = Utils::decamelize($this->modelName);
        $filePath = \Yii::getAlias('@modava/faq/views/' . $formView . '/_form.php');
        if (!file_exists($filePath)) {
            return $this->renderAjax('error-modal', [
                'errorMessage' => FaqModule::t('faq', 'Form is not existed'),
            ]);
        }

        $filePath = '@modava/faq/views/' . $formView . '/_form.php';

        $model = new $this->classModelName();
        $model->load(\Yii::$app->request->get());

        $data = \Yii::$app->request->get('data');

        return $this->renderAjax('create-modal', [
            'modelName' => $this->modelName,
            'formView' => $formView,
            'model' => $model,
            'formPath' => $filePath
        ]);
    }

    public function actionSaveAjax()
    {
        $model = new $this->classModelName();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('toastr-' . $this->toastr_key . '-save-ajax', [
                    'title' => 'Thông báo',
                    'text' => 'Tạo mới thành công',
                    'type' => 'success'
                ]);

                Yii::$app->response->format = Response::FORMAT_JSON;

                return [ 'success' => true];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return [ 'success' => true];
            }
        }
    }

    public function beforeAction($action)
    {
        $modelName = \Yii::$app->request->get('model');
        if (!$modelName) $modelName = \Yii::$app->request->post('model');
        $className = 'modava\faq\models\\' . $modelName;
        $classNameTable = 'modava\faq\models\table\\' . $modelName . 'Table';
        $classNameSearch = 'modava\faq\models\search\\' . $modelName . 'Search';

        // Validate Query Param
        if (!$modelName || !class_exists($className) || !class_exists($classNameTable) || !class_exists($classNameSearch)) {
            echo $this->renderAjax('error-modal', [
                'errorMessage' => FaqModule::t('faq', 'Object is not existed'),
            ]);

            Yii::$app->end();
        }

        $this->modelName = $modelName;
        $this->classModelName = $className;
        $this->classModelNameTable = $classNameTable;
        $this->classModelNameSearch = $classNameSearch;

        return parent::beforeAction($action);
    }

    public function actionGetListRelatedRecordsModal () {
        $formView = Utils::decamelize($this->modelName);
        $filePath = \Yii::getAlias('@modava/faq/views/' . $formView . '/related-list.php');
        if (!file_exists($filePath)) {
            return $this->renderAjax('error-modal', [
                'errorMessage' => FaqModule::t('faq', 'File is not existed'),
            ]);
        }

        $searchModel = new $this->classModelNameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('list-related-records-modal', [
            'modelName' =>  $this->modelName,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filePath' => $filePath
        ]);
    }
}