<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Caregiver extends Model
{
    use HasFactory;


    protected $fillable = [
        'profile_picture',
        'full_name',
        'gender',
        'birthdate',
        'gender',
        'email',
        'phone_number',
        'personal_id_number',
        'religion',
        'address',
        'district',
        'amphoe',
        'province',
        'zipcode',
    ];


    public function getImageURL(){
        if($this->profile_picture){
            return url('storage/'.$this->profile_picture);
        }
        return url('storage/images/no-image.svg');
    }

    public function getAge()
    {
        $birthdate = $this->birthdate;

        return Carbon::now()->diffInYears($birthdate);
    }
}
