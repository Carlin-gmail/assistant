<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemConversation extends Model
{
    protected $fillable = [
        'message_from',
        'message',
        'status',
        'subject',
        'conclusion',
        'priority',
        'distak',
        'page_url',
    ];
}
