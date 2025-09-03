<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileView extends Component
{

    public $profile;
    public $statesdata;
    public $citiesdata;
    /**
     * Create a new component instance.
     */
    public function __construct($profile,$statesdata,$citiesdata)
    {

        $this->profile = $profile;
        $this->statesdata = $statesdata;
        $this->citiesdata = $citiesdata;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile-view');
    }
}
