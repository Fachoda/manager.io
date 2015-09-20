<?php
/**
 * Created by PhpStorm.
 * User: adria
 * Date: 9/19/2015
 * Time: 2:58 PM
 */

namespace app\frontend\forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Identical;

/**
 * Class AbstractForm
 * @package app\frontend\forms
 */
abstract class AbstractForm extends Form
{
    /**
     * Associative array of form elements
     *
     * @var array
     */
    protected $formElements = [];

    /**
     * Get the fully qualified classname
     *
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }

    /**
     * Get the short name of the called form
     *
     * @return string
     */
    public function formName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * Set a csrf token for all forms
     *
     * @return Hidden
     */
    protected function attachCsrf()
    {
        $csrf = new Hidden('csrf');

        $csrf->addValidator(new Identical([
            'value'     => $this->security->getSessionToken(),
            'message'   => 'CSRF validation failed'
        ]));

        $csrf->clear();

        return $csrf;
    }

    /**
     * attach all form elements to the current form
     */
    protected function attachFormElements()
    {
        $this->add($this->attachCsrf());
        foreach ($this->formElements as $element) {
            $this->add($element);
        }
    }
}
