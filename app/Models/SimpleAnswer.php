<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleAnswer extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'group_member_id' => 'integer',
        'question' => 'string',
        'answer' => 'string'
    ];


    public function group_member ()
    {
        return $this->belongsTo('App\Models\GroupMember', 'group_member_id', 'id');
    }


}
