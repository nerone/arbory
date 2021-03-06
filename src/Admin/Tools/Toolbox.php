<?php

namespace Arbory\Base\Admin\Tools;

use Arbory\Base\Html\Elements\Element;
use Arbory\Base\Html\Html;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Toolbox
 * @package Arbory\Base\Admin\Widgets
 */
class Toolbox implements Renderable
{
    /**
     * @var string
     */
    protected $url;

    /**
     * Toolbox constructor.
     * @param $url
     */
    public function __construct( $url )
    {
        $this->url = $url;
    }

    /**
     * @return Element
     */
    public function render()
    {
        return Html::div(
            Html::div( [
                Html::button( Html::i()->addClass( 'fa fa-ellipsis-v' ) )
                    ->addClass( 'button trigger only-icon' )
                    ->addAttributes( [ 'type' => 'button' ] ),
                Html::menu( [
                    Html::i()->addClass( 'fa fa-caret-up' ),
                    Html::ul(),
                ] )
                    ->addClass( 'toolbox-items' )
                    ->addAttributes( [ 'type' => 'toolbar' ] )
            ] )
                ->addClass( 'toolbox' )
                ->addAttributes( [
                    'data-url' => $this->url,
                ] )
        )->addClass( 'only-icon toolbox-cell' );
    }

    /**
     * @param $url
     * @return Toolbox
     */
    public static function create( $url )
    {
        return new static( $url );
    }
}
