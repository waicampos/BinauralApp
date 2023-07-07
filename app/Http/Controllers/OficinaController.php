<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OficinaController extends Controller
{

    

    public function store_previo(Request $request) 
    {

        $user = Auth::user();
        // foreach($user->groups as $group) {
        //     echo $group->pivot->id;
        // }

        // dd($user->groups->id);

        $now = Carbon::now('America/Sao_Paulo');

        DB::table('simple_answers')->insert([
            [
                'group_member_id' => $user->id,
                'question' => $request->question,
                'answer' => $request->sentimento, 
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        return view('player');
    }

    public function store_final(Request $request) 
    {
        $user = Auth::user();
        // foreach($user->groups as $group) {
        //     echo $group->pivot->id;
        // }

        // dd($user->groups->id);

        $now = Carbon::now('America/Sao_Paulo');

        DB::table('simple_answers')->insert([
            [
                'group_member_id' => $user->id,
                'question' => $request->question,
                'answer' => $request->sentimento, 
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        return view('dashboard', ['user' => $user]);
    }



}
