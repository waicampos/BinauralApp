<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function verGrupos($user_id) {
        $user = User::findOrFail($user_id);
        return view('projetos.ver_usuarios', ['user' => $user]);
    }

}
