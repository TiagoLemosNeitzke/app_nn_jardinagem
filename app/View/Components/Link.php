<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $route, 
        public string $key, 
        public int $id, 
        public string $text)
    {}

    public function getBtnClass()
    {
        $btnClass = [
            'Editar' => 'btn-primary',
            'Agendar' => 'btn-success',
            'Ligar para o cliente' => 'btn-success',
            'Dados do cliente' => 'btn-success',
            'Ver mais' => 'btn-success',
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
        return view('components.link');
    }
}
