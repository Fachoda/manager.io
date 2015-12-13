<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 07.12.2015
 * Time: 21:51
 */

namespace app\base\models;

use app\base\exceptions\InvalidConfigException;
use Phalcon\Mvc\Model\ValidatorInterface;
use ReflectionClass;
use Phalcon\Mvc\Collection as PhCollection;

class Collection extends PhCollection
{
    /**
     * get the fully qualified domain name for the class
     *
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }

    /**
     * get the short name of the called class
     * always called from context
     *
     * @return string
     */
    public function getClassName()
    {
        return (new ReflectionClass($this))->getShortName();
    }

    /**
     * mass assign data via an array to the model
     *
     * @param array $data
     */
    public function assign(array $data = [])
    {
        $workset = $data;

        if ($this->isWrapped($workset)) {
            $workset = $this->getWrappedData($workset);
        }

        foreach ($workset as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    /**
     * attach multiple validators at once
     *
     * @param array $validators
     * @throws InvalidConfigException
     */
    public function attachValidators(array $validators = [])
    {
        foreach ($validators as $validator) {
            if ($validator instanceof ValidatorInterface) {
                $this->validate($validator);
            } else {
                throw new InvalidConfigException('The validator must implement Phalcon\Mvc\Model\ValidatorInterface to be valid');
            }
        }
    }

    /**
     * check if data is wrapped under $data[className()]
     *
     * @param $data
     * @return bool
     */
    protected function isWrapped(array $data = [])
    {
        return isset($data[$this->getClassName()]);
    }

    /**
     * if the data is wrapped under $data[className()] return it's contents
     *
     * @param array $data
     * @return mixed
     */
    protected function getWrappedData(array $data = [])
    {
        return $data[$this->getClassName()];
    }
}