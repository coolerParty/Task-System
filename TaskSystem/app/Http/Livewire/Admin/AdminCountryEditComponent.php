<?php

namespace App\Http\Livewire\Admin;

use App\models\Country;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AdminCountryEditComponent extends Component
{
    public $name;
    public $country_id;

    public function mount($country_id)
    {
        $country          = Country::where('id',$country_id)->first();
        $this->country_id = $country->id;
        $this->name       = $country->name;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,['name' => ['required', Rule::unique('countries')->ignore($this->country_id)],]);
    }

    public function updateCountry()
    {
       $this->validate([
        'name' => ['required', Rule::unique('countries')->ignore($this->country_id)],            
        ]);

        $country       = Country::find($this->country_id);
        $country->name = $this->name;
        $country->save();
        session()->flash('message','Country has been save successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-country-edit-component')->layout('layouts.base');
    }
}
