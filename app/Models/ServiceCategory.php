<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'name',
        'short_name',
    ];

    public function service(){
        return $this->hasMany(Service::class,'category_id');
    }
}
