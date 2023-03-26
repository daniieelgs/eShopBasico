<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'descripcio',
        'imatge',
        'preu'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function opinions(){
        return $this->hasMany(Opinio::class);
    }
}
