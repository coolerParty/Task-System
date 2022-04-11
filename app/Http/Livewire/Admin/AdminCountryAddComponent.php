<?php

namespace App\Http\Livewire\Admin;

use App\Models\Country;
use Livewire\Component;

class AdminCountryAddComponent extends Component
{
    public $name;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required|unique:countries',
        ]);
    }

    public function addCountry()
    {
        $this->validate([
            'name' => 'required|unique:countries',
       ]);

        $country = new Country();
        $country->name = $this->name;
        $country->save();
        session()->flash('message','New Country has been added successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-country-add-component')->layout('layouts.base');
    }
}
