<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component as ViewComponent;
use Livewire\Component;

class UserStatus extends Component
{
    public Model $model;
    public string $field;

    public bool $status;

    public function mount()
    {
        $this->status = (bool) $this->model->getAttribute($this->field);
    }

    public function render()
    { 
        return view('livewire.user-status');
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
    }
}
