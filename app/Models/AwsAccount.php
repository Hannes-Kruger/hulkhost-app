<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AwsAccount extends Model
{
    protected $fillable = [
        'name',
        'meta',
    ];

    protected $casts = [
        'meta' => 'encrypted:json',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
