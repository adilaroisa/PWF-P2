<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'qty',
        'price',
    ];

    // Menambahkan ": BelongsTo" di akhir fungsi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Menambahkan ": HasMany" di akhir fungsi
    public function kategoris(): HasMany
    {
        return $this->hasMany(Kategori::class);
    }
}
