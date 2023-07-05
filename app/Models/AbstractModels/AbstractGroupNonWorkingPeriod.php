<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
* Class AbstractGroupNonWorkingPeriod
* @package App\Models\AbstractModels
*
* @property tinyInteger $non_working_period_id
* @property smallInteger $group_id
*/ 
abstract class AbstractGroupNonWorkingPeriod extends Pivot
{
    /**  
     * Primary key name.
     * 
     * @var string
     */
    public $primaryKey = 'non_working_period_id';
    
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
        'non_working_period_id' => 'integer',
        'group_id' => 'integer'
    ];
}