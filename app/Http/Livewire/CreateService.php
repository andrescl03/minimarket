<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;

class CreateService extends Component
{
    
    public $name;

    
    protected $rules = [
        'name' => ['required', 'min:2', 'string', 'max:255'],
    ];

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.create-service');
    }

    public function submit()
    {
        $this->validate();
        
        Service::create(
            [
                'name' => $this->name
            ]
        );

        $this->reset();
       // $this->dispatchBrowserEvent('createServicePost');
        $this->emit('createServicePost');
    }
}
