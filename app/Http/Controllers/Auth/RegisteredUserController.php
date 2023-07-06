<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\App;
use App\Models\AppIndicator;
use App\Models\Category;
use App\Models\Indicator;
use App\Models\IndicatorOption;
use App\Models\Option;
use App\Models\SocialName;
use App\Models\User;
use App\Models\UserIndicator;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     * 
     * Also retrieves options from database to populate the forms
     * 
     * 
     */
    public function create(): View
    {       
        // $request->session()->flush();

        // Pegar os indicadores do App
        // Observação: não gostei dessa forma de ter que pegar o id do app da tabela apps
        // Mas por enquanto, vai ficar assim para simplificar..
        // Acho que vou criar uma classe e manualmente atribuir as relações dela no banco de dados 
        $app = App::find(1);
        $indicadores = $app->indicators;
 
        return view('auth.register', ['indicadores' => $indicadores]);
    }


    /**
     * Handle an incoming registration request.  
     * 
     * Default category for new user: 1
     * 
     * Default status for new user: 1
     * 
     * 
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {       

        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);

        //dd($request);

        // Fazer uma transaction tbm!
        DB::transaction(function () use ($request, $user) {  

            $user->save();

            $user = User::where('cpf', $request->cpf)->first();
            //dd($user);


            if ($user->has_social_name) {
                SocialName::create([
                    'user_id' => $user->id,
                    'firstname' => $request->social_firstname,
                    'lastname' => $request->social_lastname
                ]);
            }

            foreach($request->indicador as $indicador => $opcao) {
                DB::table('user_indicators')->insert([
                    'user_id' => $user->id,
                    'indicator_id' => $indicador,
                    'option_id' => $opcao
                ]);
            }

        }, 3);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
