<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Profile;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class UserProfileEditComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $mobile;
    public $image;
    public $line1;
    public $line2;
    public $city;
    public $province_id;
    public $country_id;
    public $zipcode;
    public $newimage;
    
    public function mount()
    {
        $user              = User::find(Auth::user()->id);
        $this->name        = $user->name;
        $this->email       = $user->email;
        $this->mobile      = $user->profile->mobile;
        $this->image       = $user->profile->image;
        $this->line1       = $user->profile->line1;
        $this->line2       = $user->profile->line2;
        $this->city        = $user->profile->city;
        $this->province_id = $user->profile->province_id;
        $this->country_id  = $user->profile->country_id;
        $this->zipcode     = $user->profile->zipcode;
        $this->newimage    = null;

    }

    public function updateProfile()
    {
        $user       = User::find(Auth::user()->id);
        $user->name = $this->name;
        $user->save();

        $user->profile->mobile = $this->mobile;
        if($this->newimage)
        {
            if($this->image)
            {
                unlink('assets/images/profile'.'/'.$user->profile->image); // Deleting Image
                unlink('assets/images/profile_thumbnail'.'/'.$user->profile->image); // Deleting Image
            }
            
            $imagename = Carbon::now()->timestamp. '.' . $this->newimage->extension();

            $thumbnailPath  = public_path().'/assets/images/profile_thumbnail/';
            $originalPath   = public_path().'/assets/images/profile/';
            $thumbnailImage = Image::make($this->newimage);
            $thumbnailImage->fit(400,400);
            $thumbnailImage->save($originalPath.$imagename);
            $thumbnailImage->fit(100,100);
            $thumbnailImage->save($thumbnailPath.$imagename); 

            $user->profile->image = $imagename;
        }
        
        $user->profile->line1       = $this->line1;
        $user->profile->line2       = $this->line2;
        $user->profile->city        = $this->city;
        $user->profile->province_id = $this->province_id;
        $user->profile->country_id  = $this->country_id;
        $user->profile->zipcode     = $this->zipcode;
        $user->profile->save();
        session()->flash('message','Profile has been updated successfully');
        return redirect(route('user.profile'));
    }

    public function render()
    {
        $countries = Country::select('id','name')->orderby('name','asc')->get();
        $provinces = Province::select('id','name')->orderby('name','asc')->get();
        return view('livewire.user.user-profile-edit-component',['countries'=>$countries,'provinces'=>$provinces])->layout('layouts.base');
    }
}
