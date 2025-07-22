<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategoria;
use App\Models\Categoria;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'cpf', 'telefone',
        'rua', 'bairro', 'numero', 'complemento',
        'cidade', 'estado', 'cep', 'subcategoria_id'
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function categoria()
    {
        return $this->hasOneThrough(
            Categoria::class,       // Model final
            Subcategoria::class,    // Model intermediário
            'id',                   // Chave local em Subcategoria
            'id',                   // Chave local em Categoria
            'subcategoria_id',      // Foreign key em Cliente
            'categoria_id'          // Foreign key em Subcategoria
        );
    }
}

