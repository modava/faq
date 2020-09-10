<?php

namespace modava\faq;

use yii\base\BootstrapInterface;
use Yii;
use yii\base\Event;
use \yii\base\Module;
use yii\web\Application;
use yii\web\Controller;

/**
 * faq module definition class
 */
class FaqModule extends Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'modava\faq\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // custom initialization code goes here
//        $this->registerTranslations();
        parent::init();
        Yii::configure($this, require(__DIR__ . '/config/faq.php'));
//        $handler = $this->get('errorHandler');
//        Yii::$app->set('errorHandler', $handler);
//        $handler->register();
        $this->layout = 'faq';
    }



    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_ACTION, function () {

        });
        Event::on(Controller::class, Controller::EVENT_BEFORE_ACTION, function (Event $event) {
            $controller = $event->sender;
        });
    }

    /*public function registerTranslations()
    {
        Yii::$app->i18n->translations['faq/messages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@modava/faq/messages',
            'fileMap' => [
                'faq/messages/faq' => 'faq.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('faq/messages/' . $category, $message, $params, $language);
    }*/
}
