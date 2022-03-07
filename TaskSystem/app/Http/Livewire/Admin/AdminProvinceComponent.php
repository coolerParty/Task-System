<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Province;

class AdminProvinceComponent extends Component
{
    public function deleteProvince($id)
    {
        $province = Province::find($id);
        $province->delete();
        session()->flash('del_message','Province has been deleted successfully!');
        return redirect(route('admin.province'));
    }

    public function render()
    {
        $provinces = Province::select('id','name','country_id','created_at')->get();
        return view('livewire.admin.admin-province-component',['provinces'=>$provinces])->layout('layouts.base');
    }
}
