<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

/**
* Class AbstractPlaylist
* @package App\Models\AbstractModels
*
* @property string $uri
* @property \Carbon\Carbon $updated_at
* @property integer $user_id
* @property \App\Models\user $user
*/ 
abstract class AbstractPlaylist extends Model
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
        'uri' => 'string',
        'updated_at' => 'datetime',
        'user_id' => 'integer'
    ];
    
    public function user()
    {
        return $this->belongsTo('\App\Models\user', 'user_id', 'id');
    }
}
