<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

 namespace App\Models\AbstractModels;
 
 // use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Laravel\Sanctum\HasApiTokens;


/**
* Class AbstractUser
* @package App\Models\AbstractModels
*
* @property integer $id
* @property string $firstname
* @property string $lastname
* @property boolean $has_social_name
* @property \Carbon\Carbon $birth_date
* @property string $cpf
* @property string $email
* @property string $password
* @property \Carbon\Carbon $email_verified_at
* @property string $remember_token
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property tinyInteger $category_id
* @property tinyInteger $civil_state_id
* @property tinyInteger $status_id
* @property \App\Models\category $category
* @property \App\Models\civilState $civilState
* @property \App\Models\status $status
* @property \App\Models\playlist $playlists
* @property \App\Models\socialName $socialNames
* @property \Illuminate\Database\Eloquent\Collection $userIndicators
*/ 

abstract class AbstractUser extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    
    /**  
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'has_social_name' => 'boolean',
        'birth_date' => 'datetime:Y-m-d',
        'cpf' => 'string',
        'email' => 'string',
        'password' => 'string',
        'email_verified_at' => 'datetime',
        'remember_token' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'category_id' => 'integer',
        'civil_state_id' => 'integer',
        'status_id' => 'integer'
    ];

    
 
     /**
      * The attributes that are mass assignable.
      *
      * @var array<int, string>
      */
     protected $fillable = [
         'name',
         'email',
         'password',
     ];
 
     /**
      * The attributes that should be hidden for serialization.
      *
      * @var array<int, string>
      */
     protected $hidden = [
         'password',
         'remember_token',
     ];
    

    public function category()
    {
        return $this->belongsTo('\App\Models\category', 'category_id', 'id');
    }
    
    public function civilState()
    {
        return $this->belongsTo('\App\Models\civilState', 'civil_state_id', 'id');
    }
    
    public function status()
    {
        return $this->belongsTo('\App\Models\status', 'status_id', 'id');
    }
    
    public function playlists()
    {
        return $this->hasOne('\App\Models\playlist', 'user_id', 'id');
    }
    
    public function socialName()
    {
        return $this->hasOne('\App\Models\socialName', 'user_id', 'id');
    }
    
    public function indicators()
    {
        return $this->hasMany('\App\Models\UserIndicator', 'user_id', 'id');
    }
    
    public function projects()
    {
        return $this->belongsToMany('\App\Models\project', 'project_team', 'user_id', 'project_id')->withPivot('role_id', 'start_at', 'finish_at');
    }
    
    public function groups()
    {
        return $this->belongsToMany('\App\Models\group', 'group_member', 'user_id', 'group_id')->withPivot('id', 'authorization', 'city', 'phone_number', 'preferred_hour', 'weekday_id');
    }
}
