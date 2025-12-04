<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'due_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_at' => 'datetime',
    ];
}
