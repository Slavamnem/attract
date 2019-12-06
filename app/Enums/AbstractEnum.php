<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 23:17
 */

namespace App\Enums;

use Illuminate\Support\Arr;

abstract class AbstractEnum
{
    /**
     * @var
     */
    protected $value;
    /**
     * @var
     */
    protected $enums;

    /**
     * AbstractEnum constructor.
     * @param null $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getEnums()
    {
        return $this->enums;
    }

    /**
     * @return array
     */
    public static function getAllEnums()
    {
        return (new static())->getEnums();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return Arr::get($this->enums, $this->getValue());
    }
}
