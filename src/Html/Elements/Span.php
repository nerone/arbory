<?php

namespace CubeSystems\Leaf\Html\Elements;

class Span extends Element
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->tag( 'span', $this->content );
    }
}
