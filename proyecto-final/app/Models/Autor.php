<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Autor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nombre',
    ];
    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'autor_libros')->withTimestamps();;
    }
}
