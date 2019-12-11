<?php

namespace craftplugins\company\assetbundle;

use craft\web\AssetBundle;

/**
 * Class FieldAssetBundle
 *
 * @package craftplugins\company\assetbundle
 */
class FieldAssetBundle extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->sourcePath = '@craftplugins/company/assetbundle/dist';

        $this->css = [
            'field.css',
        ];

        $this->js = [
            'field.js',
        ];

        parent::init();
    }
}
