<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre', 'description', 'deadline', 'priorite', 'statut', 'user_id'
    ];

    // user tasks
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
