<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FinanceHeader extends Component
{
    public $title, $link, $showCreate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $link, $showCreate)
    {
        $this->title = $title;
        $this->link = $link;
        $this->showCreate = $showCreate == 'true' ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.finance-header');
    }
}
