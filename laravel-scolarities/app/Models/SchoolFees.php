<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFees extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id')->latest();
    }
    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }


}
