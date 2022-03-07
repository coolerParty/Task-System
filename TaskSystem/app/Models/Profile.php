<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = "profiles";

    public function country()
    {
        return $this->belongsTo(Country::Class,'country_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::Class,'province_id');
    }
}
