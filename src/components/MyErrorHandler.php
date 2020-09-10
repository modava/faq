<?php
namespace modava\faq\components;

class MyErrorHandler extends \yii\web\ErrorHandler
{
    public $errorView = '@modava/faq/views/error/error.php';

}
