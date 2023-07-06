<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* Class AbstractGroupMember
* @package App\Models\AbstractModels
*
* @property smallInteger $id
* @property smallInteger $group_id
* @property integer $user_id
* @property boolean $authorization
* @property string $city
* @property string $phone_number
* @property \Carbon\Carbon $preferred_hour
* @property tinyInteger $weekday_id
* @property \App\Models\weekday $weekday
* @property \Illuminate\Database\Eloquent\Collection $eEGs
* @property \App\Models\responsibleAdult $responsibleAdults
* @property \App\Models\TLCE $tLCEs
* @property \App\Models\withdraw $withdraws
* @property \Illuminate\Database\Eloquent\Collection $groupMemberIndicadors
*/ 
abstract class AbstractGroupMember extends Pivot
{

    use SoftDeletes; 
    
    /**  
     * Do not automatically manage timestamps by Eloquent
     * 
     * @var bool
     */
    public $timestamps = false;
    
    /**  
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'group_id' => 'integer',
        'user_id' => 'integer',
        'authorization' => 'boolean',
        'reference_name' => 'string',
        'reference_phone' => 'string',
        'city' => 'string',
        'phone_number' => 'string',
        'weekday_id' => 'integer'
    ];

    //protected $guarded = ['id'];
    
    public function weekday()
    {
        return $this->belongsTo('\App\Models\weekday', 'weekday_id', 'id');
    }
    
    public function eEGs()
    {
        return $this->hasMany('\App\Models\EEG', 'group_member_id', 'id');
    }
    
    public function responsibleAdults()
    {
        return $this->hasOne('\App\Models\responsibleAdult', 'group_member_id', 'id');
    }
    
    public function tLCEs()
    {
        return $this->hasOne('\App\Models\TLCE', 'group_member_id', 'id');
    }
    
    public function withdraws()
    {
        return $this->hasOne('\App\Models\withdraw', 'group_member_id', 'id');
    }
    
    public function groupMemberIndicadors()
    {
        return $this->hasMany('\App\Models\GroupMember_Indicator', 'group_member_id', 'id');
    }
    
    public function workshops()
    {
        return $this->belongsToMany('\App\Models\workshop', 'group_member_workshop', 'group_member_id', 'workshop_id')->withPivot('id', 'attended_at', 'started_at', 'finished_at', 'total_seconds_interrupted');
    }
}
