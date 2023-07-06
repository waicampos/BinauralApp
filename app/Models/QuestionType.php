<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
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
        'name' => 'string',
    ];
    



}
    
