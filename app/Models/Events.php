<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'location', 'description', 'date', 'time'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id'
    ];

    public function user(): BelongsTo {

        return $this->belongsTo(User::class);
        
    }
}
