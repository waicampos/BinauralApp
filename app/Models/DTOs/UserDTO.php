<?php

namespace App\Models\DTOs;

use Illuminate\Database\Eloquent\Model;

class UserDTO
{
    public $name;
    public $lastname;
    public $age;
    public $indicators = [];
    public $cpf;
    public $needs_update;


    /**
     * Construct UserDTO from User
     */
    public function __construct($user) 
    {
        $this->name = $user->name();
        $this->lastname = $user->lastname();
        $this->age = $user->age();
        $this->cpf = $user->cpf;
        foreach ($user->indicators as $indicator) {
            $this->indicators[$indicator->indicator->id] = [
                'name' => $indicator->indicator->name,
                'option_id' => $indicator->option->id,
                'option_name' => $indicator->option->name,
            ];
        }
    }


}