<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
* Class AbstractProjectTeam
* @package App\Models\AbstractModels
*
* @property tinyInteger $project_id
* @property integer $user_id
* @property tinyInteger $role_id
* @property \Carbon\Carbon $start_at
* @property \Carbon\Carbon $finish_at
* @property \App\Models\role $role
*/ 
abstract class AbstractProjectTeam extends Pivot
{
    /**  
     * Primary key name.
     * 
     * @var string
     */
    public $primaryKey = 'project_id';
    
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
        'project_id' => 'integer',
        'user_id' => 'integer',
        'role_id' => 'integer',
        'start_at' => 'datetime:Y-m-d',
        'finish_at' => 'datetime:Y-m-d'
    ];
    
    public function role()
    {
        return $this->belongsTo('\App\Models\role', 'role_id', 'id');
    }
}
