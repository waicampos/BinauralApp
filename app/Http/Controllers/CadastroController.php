<?php

namespace App\Http\Controllers;

use App\Mail\TLCEMail;
use App\Models\App;
use App\Models\DTOs\UserDTO;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Project;
use App\Models\User;
use App\Models\Weekday;
use Carbon\Carbon;
use CURLFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\TemplateProcessor;
use stdClass;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Zamzar\ZamzarClient;

class CadastroController extends Controller
{


    public const PDF_API_KEY = 'pdf_live_rxxjxUhBXwrqYhTldC2M6aRACVYNDaLMbLuj4pYyvrf';


    public function gerar_tlce($group, $user)
    {

        
        $name = $user->name();
        $lastname = $user->lastname();

        

        //dd($name . " " . $lastname);

        $path = '/tlce/';
        //dd($path);

        // VER QUEUES!

        $now = Carbon::now();

        $templateProcessor = new TemplateProcessor(storage_path('app'). $path. 'template_tlce.docx');
        // var_dump($templateProcessor);
        $templateProcessor->setValue('nome', $name);
        $templateProcessor->setValue('sobrenome', $lastname);
        $templateProcessor->setValue('cpf', $user->cpf);
        $templateProcessor->setValue('dia', $now->day);
        $templateProcessor->setValue('mes', $now->month);
        $templateProcessor->setValue('ano', $now->year);

        //Precisa resolver o MIME Type pra poder manter a formatação correta! 
        //Na verdade, de preferência, resolver a questão da conversão a pdf!
        
        $newDocName = 'tlce_'. $group->id . '_' . $name . '_' . $lastname .'.docx';

        $completePath = storage_path('app').$path.$newDocName;

        $templateProcessor->saveAs($completePath);


       // $zamzar_api_key = '6a525d422d3fb37ad01d3dabde332bb6f3b1b12c';

        // $FileHandle = fopen('generated.pdf', 'w+');

        // $curl = curl_init();
        
        // $instructions = '{
        //   "parts": [
        //     {
        //       "file": "mod"
        //     }
        //   ]
        // }';
        
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://api.pspdfkit.com/build',
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_POSTFIELDS => array(
        //     'instructions' => $instructions,
        //     'document' => new CURLFILE($path.'mod.docx')
        //   ),
        //   CURLOPT_HTTPHEADER => array(
        //     'Authorization: Bearer pdf_live_rxxjxUhBXwrqYhTldC2M6aRACVYNDaLMbLuj4pYyvrf'
        //   ),
        //   CURLOPT_FILE => $FileHandle,
        // ));
        
        // $response = curl_exec($curl);
        
        // curl_close($curl);
        
        // fclose($FileHandle);

        // var_dump($response);



       // Connect to the Production API using an API Key
        // $zamzar = new ZamzarClient("6a525d422d3fb37ad01d3dabde332bb6f3b1b12c");

        // // Submit a conversion job
        // $job = $zamzar->jobs->create([
        //     'source_file' => $path.'mod.docx',
        //     'target_format' => 'pdf'
        // ]);

        // // Wait for the job to complete (the default timeout is 60 seconds)
        // $job->waitForCompletion([
        //     'timeout' => 60
        // ]);

        // // Download the converted files 
        // $job->downloadTargetFiles([
        //     'download_path' => $path
        // ]);

        // // Delete the source and target files on Zamzar's servers
        // $job->deleteAllFiles();     


        //dd($templateProcessor);

        // var_dump($path);
        // dd($newDocName);       


        return $completePath;

    }
    
    /**
     * Mostra a página de cadastro para o grupo e projeto ativos no momento
     * 
     * Envia os seguintes dados como parâmetro para a view: 
     * 
     * $user => DTO de usuário autenticado
     * 
     * $indicadores => os indicadores que precisam ser confirmados ou autenticados
     * 
     */
    public function create() {

        // Idealmente, deveria sempre usar o DTO para passar para o Controller...
        // Ou, fazer isto no construtor? Sim.. acho que no construtor...
        $user = Auth::user();

        $dto = new UserDTO($user);
        $dto->needs_update = false;

        $active_group = App::config('cadastro_ativo_grupo_id');

        $group = Group::findOrFail($active_group);
    
        // Simulando um pequeno DTO do projeto
        $groupDTO = new stdClass();
        $groupDTO->number = $group->number;
        $groupDTO->project = $group->project->name;
        // $project->needs_playlist = $group->project->has_binaural; // Este campo ainda não existe na base de dados
        $groupDTO->needs_playlist = true;

        $weekdays = [];
        foreach(Weekday::orderBy('id')->get() as $weekday) {
            $weekdays[$weekday->id] = $weekday->name;
        }

        unset($weekdays[1]);
        unset($weekdays[7]);

        //ksort($weekdays);
        // O ideal seria pegar o texto do banco de dados...
        // Provavelmente, a partir de um doc...
        // Mas aí não ficaria corretamente formatado
        // Pegar de um markdown? (seria o mais correto)

        // var_dump($dto);

        // exit();
        //Ver os indicadores que possui
        return view('cadastro_participante.cadastro', ['user' => $dto, 'group' => $groupDTO, 'weekdays' => $weekdays]);

    }


    public function store (Request $request) 
    {

        //dd($request);

        // $request = new stdClass();
        // $request->indicador = [
        //     1 => 15,
        //     2 => 20,
        //     3 => 23
        // ];
        // $request->authorization = 1; 
        // $request->city = "Floripa";
        // $request->phone_number = "48998347254";
        // $request->weekday_id = 3;
        // $request->playlist_uri = "playlist.ficticia.123456789";
        // $request->hour = '10:00:00';
        
        $user = Auth::user();
        
        // $user->id = 12;

        // São modificações em várias tabelas... o ideal seria uma transaction para assegurar que todas elas serão feitas corretamente

        // Como vai vir do indicador?
        // Tem que vir nesse formato
        // Usando o upsert para Atualizar indicadores do usuário se necessário
        // foreach($request->indicador as $indicador => $opcao) {
        //     DB::table('user_indicators')->upsert(
        //         [
        //             ['user_id' => $user->id, 'indicator_id' => $indicador, 'option_id' => $opcao]
        //         ],
        //         ['user_id', 'indicator_id'],
        //         ['option_id']
        //     );
        // }
        $active_group = App::config('cadastro_ativo_grupo_id');
        $group = Group::findOrFail($active_group);

        $groupMember = DB::transaction(function () use ($request, $user, $group) {  

        $groupMember = new GroupMember();
        
        $groupMember->group_id = $group->id;
        $groupMember->user_id = $user->id;
        $groupMember->authorization = $request->authorization;
        $groupMember->city = $request->city;
        $groupMember->phone_number = $request->phone_number;
        $groupMember->weekday_id = $request->weekday_id;
        $groupMember->preferred_hour = $request->preferred_hour;

        $groupMember->save();

        $groupMember = GroupMember::where('user_id', $user->id)->first();

        //var_dump($groupMember);

        // Inserindo na playlist
        // Tem que vir como playlist_uri
        DB::table('playlists')->insert([
            'user_id' => $user->id,
            'uri' => $request->playlist_uri,
            'updated_at' => Carbon::now()
        ]);


        if ($user->age() < 18) {	
            DB::table('responsible_adults')->insert([
                'group_member_id' => $groupMember->id,
                'phone_number' => $request->responsavel_nome,
                'fullname' => $request->responsavel_phone
            ]);
        }

        // Inserindo indicadores para o projeto
        // AINDA nÂO FOI CRIADA ESSA TABELA!
        // id	groupMember_id	indicator_id	option_id
        // Por enquanto, vou fazer só do user mesmo....
        // foreach ($user->indicators as $indicator) {
        //     $this->indicators[$indicator->indicator->id] = [
        //         'name' => $indicator->indicator->name,
        //         'option_id' => $indicator->option->id,
        //         'option_name' => $indicator->option->name,
        //     ];
        // }
        foreach($user->indicators as $indicator) {
            DB::table('group_member_indicators')->insert([
                'group_member_id' => $groupMember->id,
                'indicator_id' => $indicator->indicator->id,
                'option_id' => $indicator->option->id
            ]);
        }

        if ($groupMember->authorization) {
            $tlce_path = $this->gerar_tlce($group, $user);

            $person = new stdClass();
            $person->name = $user->name();
            $person->email = $user->email;
            Mail::to($person)->send(new TLCEMail($tlce_path));
    
            // TLCE
            // Chegou a hora de mexer com o OOXML
            // E criar um template e salvar coisas no storage
            // Oba! Vamos lá!
    
            // Será que aqui é o momento ideal de fazer isso? 
    
            DB::table('tlces')->insert([
                'group_member_id' => $groupMember->id,
                'url' => $tlce_path,
                'sent_at' => Carbon::now()
            ]);
    
        }

    

    }, 5);

        return redirect('/');

    }




}
