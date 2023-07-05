<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

/**
* Class AbstractProject
* @package App\Models\AbstractModels
*
* @property tinyInteger $id
* @property string $name
* @property string $description
* @property string $contact
* @property \Carbon\Carbon $starts_at
* @property \Carbon\Carbon $ends_at
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property tinyInteger $status_id
* @property \App\Models\status $status
* @property \Illuminate\Database\Eloquent\Collection $groups
* @property \Illuminate\Database\Eloquent\Collection $files
*/ 
abstract class AbstractProject extends Model
{
    /**  
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'contact' => 'string',
        'starts_at' => 'datetime:Y-m-d',
        'ends_at' => 'datetime:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status_id' => 'integer'
    ];
    
    public function status()
    {
        return $this->belongsTo('\App\Models\status', 'status_id', 'id');
    }
    
    public function groups()
    {
        return $this->hasMany('\App\Models\group', 'project_id', 'id');
    }
    
    public function files()
    {
        return $this->hasMany('\App\Models\file', 'project_id', 'id');
    }
    
    public function users()
    {
        return $this->belongsToMany('\App\Models\user', 'project_team', 'project_id', 'user_id')->withPivot('role_id', 'start_at', 'finish_at');
    }
}
