<?php

namespace craftplugins\company\models;

use craft\base\Model;

/**
 * Class CompanyModel
 *
 * @package craftplugins\company\models
 */
class CompanyModel extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $domain;

    /**
     * @var string
     */
    public $logo;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}
