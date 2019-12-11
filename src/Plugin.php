<?php

namespace craftplugins\company;

use Craft;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use craft\web\View;
use craftplugins\company\assetbundle\FieldAssetBundle;
use craftplugins\company\fields\CompanyField;
use yii\base\Event;

/**
 * Class Plugin
 *
 * @package craftplugins\company
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        if (Craft::$app->request->isCpRequest) {
            // Register asset bundle
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function () {
                    $view = Craft::$app->getView();
                    $view->registerAssetBundle(FieldAssetBundle::class);
                }
            );
        }

        // Register field
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = CompanyField::class;
            }
        );
    }
}
