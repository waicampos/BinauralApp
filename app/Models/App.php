<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class App extends \App\Models\AbstractModels\AbstractApp
{

    public static function config ($config_name) 
    {
        return DB::table('configs')->select('value')->where('name', $config_name)->first()->value;
    }

}
