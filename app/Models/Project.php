<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'status',
        'start_date',
        'due_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
    ];

    /**
     * The user who owns the project.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Tasks belonging to the project.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}