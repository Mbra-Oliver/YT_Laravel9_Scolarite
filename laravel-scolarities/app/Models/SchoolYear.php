<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SchoolYear extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [''];

    public function toSearchableArray()
    {
        return [
            'school_year' =>  $this->school_year,
            'current_Year' => $this->current_Year,
            'active' =>  $this->active,
        ];
    }
}
