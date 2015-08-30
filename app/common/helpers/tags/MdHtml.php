<?php

namespace app\common\helpers\tags;

use Phalcon\Tag\Exception as TagException;

class MdHtml implements HtmlInterface
{
    public $tagBegin = '';
    public $tagEnd = '';
    public $content = '';

    public static function className()
    {
        return get_called_class();
    }

    public function restrictions()
    {
        return [];
    }

    public function attributes()
    {
        return [];
    }

    public function begin()
    {
        return $this->tagBegin;
    }

    public function end()
    {
        return $this->tagEnd;
    }

    /**
     * render the template
     *
     * @return string
     */
    public function render()
    {
        return $this->tagBegin . $this->content . $this->tagEnd;
    }

    /**
     * set the content of the template, throw exception if invalid
     *
     * @param string $content
     * @return $this
     * @throws TagException
     */
    public function setContent($content = '')
    {
        if (!is_string($content)) {
            throw new TagException('unsupported tag content, must be a string');
        }

        $this->content = $content;

        return $this;
    }

    /**
     * set the attributes of the element
     * unknown attributes are treated as additional
     *
     * @param array $options
     * @return $this
     */
    public function setOptions($options = [])
    {
        $options = $this->sanitizeOptions($options);
        $this->tagBegin = self::rep($this->tagBegin, $options);
        return $this;
    }

    /**
     * check if the passed value is the same as the validation rule
     *
     * @param $type
     * @param $value
     * @return bool
     */
    public function hasType($type, $value)
    {
        switch ($type) {
            case 'boolean':
                return is_bool($value);
            case 'string':
                return is_string($value);
            case 'number':
                return is_numeric($value);
        }

        return true;
    }

    /**
     * check which attributes pass the validation rules
     *
     * @param $attr
     * @param $value
     * @return bool
     */
    public function passRestrictions($attr, $value)
    {
        $restrictions = $this->restrictions();

        if (!isset($restrictions[$attr])) {
            return true;
        }

        if ($restrictions[$attr]['showIfFalse'] === false && $value === false) {
            return false;
        }

        if (isset($restrictions[$attr]['values']) &&
            !in_array($value, $restrictions[$attr]['values'])) {
            return false;
        }

        if (isset($restrictions[$attr]['type']) &&
            !$this->hasType($restrictions[$attr]['type'], $value)) {
            return false;
        }

        return true;
    }

    /**
     * set attribute form to attribute="value"
     *
     * @param array $options
     * @return array
     */
    public function sanitizeOptions($options = [])
    {
        $attributes = $this->attributes();

        if (is_null($attributes)) {
            return [];
        }

        $sanitized = [];
        $additional = [];
        foreach ($options as $attr => $value) {
            if (!isset($attributes[$attr]) && $this->passRestrictions($attr, $value)) {
                $additional[] = " {$attr}=\"{$value}\"";
            } elseif ($attr === 'content') {
                $sanitized[$attr] = $value;
            } elseif ($this->passRestrictions($attr, $value)) {
                $sanitized[$attr] = " {$attributes[$attr]}=\"{$value}\"";
            }
        }

        //defaults to ''
        foreach ($attributes as $attr => $alias) {
            if (!isset($sanitized[$attr])) {
                $sanitized[$attr] = '';
            }
        }

        $sanitized['additional'] = implode(' ', $additional);

        return $sanitized;
    }


    /**
     * replate occurences of the type {param} with actual value provided in array
     *
     * @param $template
     * @param array $params
     * @return string
     */
    public static function rep($template, $params = [])
    {
        $p = [];
        foreach ((array) $params as $name => $value) {
            $p['{' . $name . '}'] = $value;
        }

        return ($p === []) ? $template : strtr($template, $p);
    }
}
