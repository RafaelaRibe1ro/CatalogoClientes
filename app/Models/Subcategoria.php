<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'categoria_id'];
    public function categoria() { return $this->belongsTo(Categoria::class); }
    public function clientes() { return $this->hasMany(Cliente::class); }

}
