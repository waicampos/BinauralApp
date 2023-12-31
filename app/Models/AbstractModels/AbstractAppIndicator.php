<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
* Class AbstractAppIndicator
* @package App\Models\AbstractModels
*
* @property tinyInteger $indicator_id
* @property tinyInteger $app_id
*/ 
abstract class AbstractAppIndicator extends Pivot
{
    /**  
     * Primary key name.
     * 
     * @var string
     */
    public $primaryKey = 'indicator_id';
    
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
        'indicator_id' => 'integer',
        'app_id' => 'integer'
    ];
}
