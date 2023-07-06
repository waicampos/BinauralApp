<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupQuestionaire extends Model
{

    use HasFactory, SoftDeletes;

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
        'questionaire_id' => 'integer',
        'group_id' => 'integer',
        'interval' => 'integer',
        'before' => 'boolean',
        'description' => 'string',
        'deleted_at' => 'string'
    ];
    

    public function questionaire()
    {
        return $this->belongsToMany('\App\Models\questionaire', 'questionaire_questions');
    }


    public function group()
    {
        return $this->belongsToMany('\App\Models\group', 'questionaire_questions');
    }




}