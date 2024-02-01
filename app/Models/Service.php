<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $with = ['patient:id,full_name,phone_number,personal_id_number,gender,birthdate'];
    protected $fillable = [
        'patient_id',
        'category_id',
        'user_id',
        'service_number',
        'service_detail',
        'service_date',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function service_category(){
        return $this->belongsTo(ServiceCategory::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getThDate()
    {
        $date = explode('-', $this->service_date);

        $thYear = intval($date[0]) + 543;

        $thDate = $date[2] . '-' . $date[1] . '-' . $thYear;

        return $thDate;
    }
}
