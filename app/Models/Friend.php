<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'friend_id',
    ];

    // Define the many-to-many relationship
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
