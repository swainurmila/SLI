<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuestionForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $questiondata;
    public function __construct($questiondata)
    {
        $this->questiondata = $questiondata;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.question-form');
    }
}
