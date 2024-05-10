<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Libro extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'ISBN',  
    ];
    public function autor(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'autor_libros');
    }
}
