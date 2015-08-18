<?php

namespace app\common\helpers\tags;

interface HtmlInterface
{

    /**
     * renders the tag on screen (outputs)
     *
     * @return mixed
     */
    public function render();

    /**
     * set the content of the tag, string only
     *
     * @param string $content
     * @return mixed
     */
    public function setContent($content = '');

    /**
     * set the attributes of the tag
     *
     * @param array $options
     * @return mixed
     */
    public function setOptions($options = []);
}