<?php

namespace CubeSystems\Leaf\Html\Elements;

/**
 * Class Button
 * @package CubeSystems\Leaf\Html\Elements
 */
class Button extends Element
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->tag( 'button', $this->content );
    }
}
