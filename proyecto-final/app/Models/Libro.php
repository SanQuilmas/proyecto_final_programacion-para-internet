<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Libro extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
    ];
    public function autors(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'autor_libros')->withTimestamps();;
    }

    public function isbns(): HasMany
    {
        return $this->hasMany(ISBN::class);
    }

}
