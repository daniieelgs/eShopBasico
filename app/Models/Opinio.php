<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinio extends Model
{

    protected $fillable = [
        'estrellas',
        'opinio'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function producte(){
        return $this->belongsTo(Producte::class);
    }

    use HasFactory;
}
