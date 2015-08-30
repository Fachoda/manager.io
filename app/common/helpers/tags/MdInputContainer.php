<?php

namespace app\common\helpers\tags;

class MdInputContainer extends MdHtml
{
    public $tagBegin = '<md-input-container{id}{class}{additional}>';
    public $tagEnd = '</md-input-container>';
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
            'aria-label' => 'aria-label'
        ];
    }

    public function setContent($content = '')
    {
        $this->content = <<<HTML
        <label>$content</label>
        <input type="text" required md-maxlength="10" />
HTML;
        return $this;
    }
}
