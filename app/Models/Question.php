<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

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
        'text' => 'string',
        'question_type_id' => 'integer',
        'tendency_id' => 'integer'
    ];
    
    public function type()
    {
        return $this->belongsTo('\App\Models\questionType', 'question_type_id', 'id');
    }

    public function options()
    {
        return $this->hasMany('\App\Models\questionOptions', 'question_id', 'id');
    }

    public function questionaires()
    {
        return $this->belongsToMany('\App\Models\questionaire', 'questionaire_questions');
    }


}
    
