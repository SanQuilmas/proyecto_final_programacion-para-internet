<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ISBN extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'isbn',
    ];
    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class);
    }
}
