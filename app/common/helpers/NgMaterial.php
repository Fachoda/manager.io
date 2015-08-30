<?php

namespace app\common\helpers;

use app\common\helpers\tags\MdButton;
use app\common\helpers\tags\MdInputContainer;
use Phalcon\Tag\Exception as TagException;

class NgMaterial
{
    private static $instance;

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private static function classMap()
    {
        return [
            'button' => MdButton::className(),
            'input-container' => MdInputContainer::className()
        ];
    }

    public function getObject($type)
    {
        $mappings = self::classMap();
        if (!isset($mappings[$type])) {
            throw new TagException("Unsupported tag: '{$type}'");
        }

        if (is_null($object = new $mappings[$type]())) {
            throw new TagException("There was a problem creating your tag: '{$type}'");
        }

        return $object;
    }

    public function render($type, $content = '', $options = [])
    {
        echo $this->getObject($type)->setContent($content)->setOptions($options)->render();
    }

    public function begin($type, $options = [])
    {
        echo $this->getObject($type)->setOptions($options)->begin();
    }

    public function end($type)
    {
        echo $this->getObject($type)->end();
    }
}
