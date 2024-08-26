<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'estado_completada', 'categoria_id'];

    // Relación con el modelo Categoria
    public function categoria()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
}
