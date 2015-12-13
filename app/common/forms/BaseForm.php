<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 13.12.2015
 * Time: 16:29
 */

namespace app\common\forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Form as PhForm;
use Phalcon\Validation\Validator\Identical;

/**
 * Class BaseForm
 * @package app\common\forms
 */
abstract class BaseForm extends PhForm
{
    /**
     * @var array<string>
     */
    protected $bindElements = [];

    /**
     * @var array<FormInterface>
     */
    protected $formElements = [];

    /**
     * get the fully qualified domain name of the form
     *
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }

    /**
     * get the short name of the form
     *
     * @return string
     */
    public function formName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * initialize the form elements before use
     */
    protected function initFormElements()
    {
        foreach ($this->bindElements as $element) {
            $binder = $this->camelize('bind_' . $element);
            if (method_exists($this, $binder)) {
                $this->formElements = call_user_func([$this, $binder]);
            }
        }
    }

    /**
     * attach csrf token to all forms
     *
     * @return Hidden
     */
    protected function attachCsrf()
    {
        $csrf = new Hidden('csrf');

        $csrf->addValidator(new Identical([
            'value'     => $this->security->getSessionToken(),
            'message'   => 'CSRF token validation failed'
        ]));

        $csrf->clear();

        return $csrf;
    }

    /**
     * attach all the members of the form
     */
    protected function attachFormElements()
    {
        $this->add($this->attachCsrf());
        $this->initFormElements();
        foreach ($this->formElements as $element) {
            $this->add($element);
        }
    }

    /**
     * transform an underscore name into a camelcase one
     *
     * @param $input
     * @param string $separator
     * @return mixed
     */
    private function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', lcfirst(ucwords($input, $separator)));
    }
}