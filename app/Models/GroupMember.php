<?php
namespace App\Models;

class GroupMember extends \App\Models\AbstractModels\AbstractGroupMember
{

    public function answers ()
    {
        return $this->hasMany('App\Models\SimpleAnswer', 'group_member_id', 'id');
    }

}
