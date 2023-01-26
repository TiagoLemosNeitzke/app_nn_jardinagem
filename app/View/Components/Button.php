<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{    
   
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( public string $text, public string $type)
    {
       //
    }

    public function getBtnClass(){
        $btnClass = [
            'Apagar' => 'btn-danger',
            'Dados do cliente' => 'btn-success',
            'Notificar' => 'btn-success',
            'Cobrar' => 'btn-success',
            'Realizado' => 'btn-success',
            'Marcar como pago' => 'btn-success'
        ];

        return $btnClass[$this->text];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
