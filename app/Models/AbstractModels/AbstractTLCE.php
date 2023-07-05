<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

/**
* Class AbstractTLCE
* @package App\Models\AbstractModels
*
* @property string $url
* @property \Carbon\Carbon $sent_at
* @property smallInteger $group_member_id
* @property \App\Models\group_member $groupMember
*/ 
abstract class AbstractTLCE extends Model
{
    /**  
     * Primary key is non-autoincrementing.
     * 
     * @var bool
     */
    public $incrementing = false;
    
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
        'url' => 'string',
        'sent_at' => 'datetime',
        'group_member_id' => 'integer'
    ];
    
    public function groupMember()
    {
        return $this->belongsTo('\App\Models\group_member', 'group_member_id', 'id');
    }
}
