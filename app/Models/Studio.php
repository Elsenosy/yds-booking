<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'max_day_reservations',
    ];

    /**
     * Relationships
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'employee_studio', 'studio_id', 'employee_id');
    }
}
