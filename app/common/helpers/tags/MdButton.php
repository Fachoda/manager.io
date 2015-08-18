<?php

namespace app\common\helpers\tags;

class MdButton extends MdHtml
{
    public $tagBegin = '<md-button{id}{class}{no-ripple}{ripple-size}{aria-label}{additional}>';
    public $tagEnd = '</md-button>';
    public $content = '';

    /**
     * validation rules for the element's attributes
     *
     * @return array
     */
    public function restrictions()
    {
        return [
            'id' => [
                'type' => 'string',
                'showIfFalse' => true
            ],
            'class' => [
                'type' => 'string',
                'showIfFalse' => true
            ],
            'no-ripple' => [
                'type' => 'boolean',
                'showIfFalse' => false,
                'values' => [true, false]
            ],
            'ripple-size' => [
                'type' => 'string',
                'showIfFalse' => true,
                'values' => ['full', 'partial', 'auto']
            ],
            'aria-label' => [
                'type' => 'string',
                'showIfFalse' => true
            ],
        ];
    }

    /**
     * basic attributes of the element (map simple-attribute => angular-attribute
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => 'id',
            'class' => 'class',
            'no-ripple' => 'md-no-ink',
            'ripple-size' => 'md-ripple-size',
            'aria-label' => 'aria-label'
        ];
    }
}