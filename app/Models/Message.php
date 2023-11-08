<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_name',
        'game_id',
        'created_at',
        'sender',
        'receiver',
        'message_content'
    ];
}
