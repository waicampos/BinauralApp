<?php
namespace App\Models;
use App\Models\AbstractModels\AbstractUser;
use Carbon\Carbon;

class User extends AbstractUser
{

    


    protected $attributes = [
        'status_id' => 1,
        'category_id' => 1,
        'civil_state_id' => 1 
    ];

    protected $fillable = [
        'firstname',
        'lastname',
        'has_social_name',
        'birth_date',
        'cpf',
        'email',
        'password'
    ];


    public function name() 
    {
        if ($this->has_social_name) {
            $this->firstname = $this->socialName->firstname;
        }
        return $this->firstname;
    }

    public function lastname() 
    {
        if ($this->has_social_name) {
            $this->lastname = $this->socialName->lastname;
        }
        return $this->lastname;
    }

    public function age() 
    {
        return Carbon::parse($this->birth_date)->age; 
    }
    

}
