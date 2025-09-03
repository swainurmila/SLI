<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Course\CrSyllabus;

class ModalMaster extends Component
{
    /**
     * Create a new component instance.
     */
    public $modaldata;
    public $sysid;
    public function __construct($modaldata,$sysid)
    {
        $this->modaldata = $modaldata;
        $this->sysid = CrSyllabus::where('id',$sysid)->first();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-master');
    }
}
