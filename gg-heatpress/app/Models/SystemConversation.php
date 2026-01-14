<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemConversation extends Model
{
    protected $fillable = [
        'assigned_to',
        'category',
        'conclusion',
        'distak',
        'due_date',
        'message_from',
        'message',
        'status',
        'subject',
        'priority',
        'position',
        'page_url',
    ];
}
