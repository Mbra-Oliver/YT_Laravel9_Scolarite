<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $guarded = [''];

    //1 classe n'appartient pas a plusieur niveau
    // Un niveau peut avoir plusieurs classe associé

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
