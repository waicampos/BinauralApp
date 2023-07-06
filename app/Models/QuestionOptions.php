<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOptions extends Model
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
        'question_id' => 'integer',
        'text' => 'string'
    ];
    
    public function question()
    {
        return $this->belongsTo('\App\Models\question', 'question_id', 'id');
    }


}
    
