<?php

namespace App\Http\Livewire\Admin;

use App\Models\Country;
use Livewire\Component;

class AdminCountryComponent extends Component
{
   


    public function deleteCountry($id)
    {
        $country = Country::find($id);
        $country->delete();
        session()->flash('del_message','Country has been deleted successfully!');
        return redirect()->to(route('admin.country')); // to refresh the page
    }

    public function render()
    {
        $countries = Country::select('id','name','created_at')->get();
        return view('livewire.admin.admin-country-component',['countries'=>$countries])->layout('layouts.base');
    }
}
