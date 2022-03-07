<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Validation\Rule;

class AdminProvinceEditComponent extends Component
{
    public $province_id;
    public $name;
    public $country_id;

    public function mount($province_id)
    {
        $province          = Province::find($province_id);
        $this->name        = $province->name;
        $this->country_id  = $province->country_id;
        $this->province_id = $province->id;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'       => ['required', Rule::unique('provinces')->ignore($this->province_id)],
            'country_id' => 'required',
        ]);
    }

    public function updateProvince()
    {
       $this->validate([
            'name'       => ['required', Rule::unique('provinces')->ignore($this->province_id)],
            'country_id' => 'required',
        ]);

        $province             = Province::where('id',$this->province_id)->first();
        $province->name       = $this->name;
        $province->country_id = $this->country_id;
        $province->save();
        session()->flash('message','Province has been save successfully!');
    }


    public function render()
    {
        $countries = Country::select('id','name')->orderby('name','ASC')->get();
        return view('livewire.admin.admin-province-edit-component',['countries'=>$countries])->layout('layouts.base');
    }
}
