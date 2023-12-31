<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

/**
* Class AbstractSocialName
* @package App\Models\AbstractModels
*
* @property integer $user_id
* @property string $firstname
* @property string $lastname
* @property \App\Models\user $user
*/ 
abstract class AbstractSocialName extends Model
{
    /**  
     * Primary key name.
     * 
     * @var string
     */
    public $primaryKey = 'user_id';
    
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
        'user_id' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string'
    ];

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('\App\Models\user', 'user_id', 'id');
    }
}
