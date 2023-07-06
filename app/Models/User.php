<?php
namespace App\Models;
use App\Models\AbstractModels\AbstractUser;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;

class User extends AbstractUser
{

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

    public function active_group() 
    {
        foreach($this->groups as $group) 
        {
            if ($group->status->id === 1) {
                return $group;
            }
        }
    }

    public function is_member() 
    {
        return $this->category->id === 2;
    }


    /** 
     * Checks if now and today is workshop time!
     */
    public function is_workshop_time()
    {
        
        $tz = 'America/Sao_Paulo';
        $duration = 20;
        //ver se agora 
        // é maior ou igual ao horário da oficina        
        $now = Carbon::now($tz);

        // Criar carbon a partir da hora da oficina
        $workshop_start = Carbon::createFromTimeString($this->active_group()->hour, $tz);
        $workshop_end = Carbon::createFromTimeString($this->active_group()->hour, $tz);
        $workshop_end->addMinutes($duration);
        //$workshop_end = $workshop_start->addMinutes($duration);

        //dd($workshop_end);

        if ($this->active_group()->weekday->id === $now->dayOfWeekIso) {
            if ($now->greaterThanOrEqualTo($workshop_start)) {
                if($now->lessThanOrEqualTo($workshop_end)) {
                    return true;
                }
            }
        }
        return false;

    }

    // public function proxima_oficina ()
    // {
    //     $dia_semana = ucwords($user->active_group()->weekday->portuguese);
    //     // $dia_mes = ;
    //     // $hora = ;
    //     return 
    //     Carbon::createFromTimeString($user->active_group()->hour, 'America/Sao_Paulo')->format('H:i')
    // }



    public function gerarAgenda() 
    {

        $weekday = $this->active_group()->weekday->name;
        $hora = $this->active_group()->hour;
        $start_date = $this->active_group()->project->starts_at->format('Y-m-d');
        $end_date = $this->active_group()->project->ends_at->format('Y-m-d');



        $endDate = date_create($end_date . " " . $hora);
        date_modify($endDate, "+1 day");
        $endDate = date_format($endDate,"Y-m-d");
        
        

        $datePeriod = new DatePeriod(
            new DateTime("$weekday $start_date $hora"),
            DateInterval::createFromDateString("next $weekday"),
            new DateTime("$weekday $endDate")
        );




        $datelist = [];
        foreach($datePeriod as $date) {
            $datelist[] = $date;
        }

        return $datelist;

    }

    public function proxima_oficina() 
    {
        // Gera datas pela agenda
        // Retorna a oficina
        // Caso a próxima seja feriado, manda aviso também
        $datas = $this->gerarAgenda();

        return $datas[0];

    }


    public function proxima_oficina_string() 
    {
        $date = Carbon::create($this->proxima_oficina());
        $weekday = $date->locale('pt')->dayName;
        $month_day = $date->format('d/m');
        $hour = $date->format('H:i');
        $string = $weekday . ', ' . $month_day . ' às ' . $hour . 'h';
        //dd($string);
        return $string;
    }
    

}
