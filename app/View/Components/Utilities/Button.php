<?php

namespace App\View\Components\Utilities;

use Illuminate\View\Component;

class Button extends Component
{

    public $type,
        $class,
        $color,
        $size,
        $shade,
        $outline,
        $hovermod,
        $action,
        $icon,
        $iconSize,
        $iconColor,
        $disabled,
        $flat,
        $link,
        $block,
        $confirm,
        $ring;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $type = 'button',
        $color = 'gray',
        $size = 'md',
        $lighter = false,
        $darker = false,
        $outline = false,
        $action = null,
        $icon = null,
        $disabled = false,
        $flat = false,
        $link = false,
        $block = false,
        $confirm = false
    ) {
        $this->type      = $type;
        $this->action    = $action;
        $this->color     = $color == 'white' ? 'gray' : $color;
        $this->size      = $size;
        $this->shade     = $darker ? 800 : ($lighter ? 400 : 600);
        $this->hovermod  = $darker ? $this->shade - 100 : $this->shade + 100;
        $this->outline   = $outline ? true : ($color == 'white' ? true : false);
        $this->flat      = $flat;
        $this->ring      = $this->shade - 100;
        $this->icon      = $icon ? (substr($icon, 0, 2) == 's-' || substr($icon, 0, 2) == 'o-') ? $icon : ($this->outline ? 'o-' . $icon : 's-' . $icon) : null;
        $this->iconColor = $this->outline || $this->flat ? $this->color : 'white';
        $this->disabled  = $disabled;
        $this->link      = $link;
        $this->block     = $block;
        $this->confirm   = $confirm;

        if($this->color == 'black'){
            $this->color = 'gray';
            $this->shade = 900;
        }

        $this->classify();

        $this->color = $this->color == 'white' ? $this->color : $this->color . '-' . $this->shade;
    }

    public function classify()
    {

        /** Static classes */
        $this->class = 'inline-flex items-center justify-center font-semibold text-xs';

        !$this->flat ? $this->class .= ' rounded-md shadow-lg focus:outline-none' : false;

        /** Sizing */
        switch ($this->size) {
            case 'xxs':
                // X-Small
                $this->class .= ' px-1 text-xxs md:px-2 py-0.5';
                $this->iconSize = '2.5';
                break;
            case 'xs':
                // X-Small
                $this->class .= ' px-2 text-xxs md:px-2.5 py-0.5 md:text-xs';
                $this->iconSize = '3';
                break;
            case 'sm':
                // Small
                $this->class .= ' px-2 py-1.5 text-xs leading-4 md:px-3 md:py-1.5 md:text-sm';
                $this->iconSize = '3';
                break;
            case 'md':
                // Medium (Default)
                $this->class .= ' px-4 py-2 text-sm';
                $this->iconSize = '4';
                break;
            case 'lg':
                // Large
                $this->class .= ' px-4 py-2 text-sm md:px-6 md:py-2.5 md:text-base';
                $this->iconSize = '5';
                break;
            case 'xl':
                // X-Large
                $this->class .= ' px-6 py-2.5 text-base md:px-8 md:py-3.5 md:text-lg';
                $this->iconSize = '6';
                break;
            default:
                // Default
                $this->class .= ' px-3 py-1 text-sm md:px-4 md:py-2 md:text-sm';
                $this->iconSize = '4';
                break;
        }

        /** Coloring */
        if ($this->flat) {

            // Uppercase
            $this->class .= ' uppercase';
            // Background
            $this->class .= ' bg-transparent';
            // Text Color
            $this->class .= ' text-' . $this->color . '-' . $this->shade;
            // Hover Text Color
            $this->class .= ' hover:text-' . $this->color . '-' . $this->hovermod;
        } else if ($this->outline) {

            // Background
            $this->class .= ' bg-white';
            // Border
            $this->class .= ' border border-' . $this->color . '-' . $this->shade;
            // Hover Text Color
            $this->class .= ' hover:border-' . $this->color . '-' . $this->hovermod;
            // Text Color
            $this->class .= ' text-' . $this->color . '-' . $this->shade;
            // Hover Text Color
            $this->class .= ' hover:text-' . $this->color . '-' . $this->hovermod;
            // Hover
            $this->class .= ' hover:bg-' . $this->color . '-50';
            // Focus
            $this->class .= ' focus:ring-' . $this->color . '-' . $this->ring;
        } else {

            // Background
            $this->class .= ' bg-' . $this->color . '-' . $this->shade;
            // Border
            $this->class .= ' border border-transparent';
            // Text Color
            $this->class .= ' text-white';
            // Hover
            $this->class .= ' hover:bg-' . $this->color . '-' . $this->hovermod;
            // Focus
            $this->class .= ' focus:ring-' . $this->color . '-' . $this->ring;
        }

        $this->disabled ? $this->class .= ' opacity-50 cursor-not-allowed' : false;

        $this->block ? $this->class .= ' w-full' : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utilities.button');
    }
}