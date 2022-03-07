<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Country;
use App\Models\Province;

class AdminProvinceAddComponent extends Component
{
    public $name;
    public $country_id;

    public function mount()
    {
        $this->country_id = null;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required|unique:countries',
            'country_id' => 'required',
        ]);
    }

    public function addProvince()
    {
        $this->validate([
            'name' => 'required|unique:countries',
            'country_id' => 'required',
       ]);

        $province = new Province();
        $province->name = $this->name;
        $province->country_id = $this->country_id;
        $province->save();
        session()->flash('message','New Province has been added successfully!');
    }

    public function render()
    {
        $countries = Country::select('id','name')->orderby('name','ASC')->get();
        return view('livewire.admin.admin-province-add-component',['countries'=>$countries])->layout('layouts.base');
    }
}
