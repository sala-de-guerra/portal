<?php

namespace App\Classes;

use Cmixin\BusinessDay;
use Illuminate\Support\Carbon;

// $dtaUtil = DiasUteisClass::contadorDiasUteis('2020-05-12', 3);

class DiasUteisClass
{
    public static function contadorDiasUteis($data, $quantidadeDiasUteis) 
    {
        $dataProposta = Carbon::parse($data);
        $diasUteis = 0;

        $feriados = array(
            'dia-mundial-da-paz' => '01-01',
            'terca-carnaval' => '= easter -47',
            'segunda-carnaval' => '= easter -48',
            'sexta-feira-da-paixao' => '= easter -2',
            'tirandentes' => '04-21',
            'trabalho' => '05-01',
            'corpus-christi' => '= easter 60',
            'independencia-do-brasil' => '09-07',
            'nossa-sra-aparecida' => '10-12',
            'finados' => '11-02',
            'proclamacao-republica' => '11-15',
            'natal' => '12-25',
            'ultimo-dia-util' => '12-31',
        );
        
        BusinessDay::enable('Illuminate\Support\Carbon', 'br-national', $feriados);
        Carbon::setHolidaysRegion('br-national');
        while ($diasUteis < $quantidadeDiasUteis) {
            $dataProposta->addDay();
            if (!$dataProposta->isBusinessDay()) {
                $dataProposta = $dataProposta->nextBusinessDay();
            }
            $diasUteis++;
        }
        return $dataProposta->format('Y-m-d');
    }

    public static function retornaPassadoEmQuantidadeDiasUteis($data, $quantidadeDiasUteis) 
    {
        $dataProposta = Carbon::parse($data);
        $diasUteis = 0;
 
        $feriados = array(
            'dia-mundial-da-paz' => '01-01',
            'terca-carnaval' => '= easter -47',
            'segunda-carnaval' => '= easter -48',
            'sexta-feira-da-paixao' => '= easter -2',
            'tirandentes' => '04-21',
            'trabalho' => '05-01',
            'corpus-christi' => '= easter 60',
            'independencia-do-brasil' => '09-07',
            'nossa-sra-aparecida' => '10-12',
            'finados' => '11-02',
            'proclamacao-republica' => '11-15',
            'natal' => '12-25',
            'ultimo-dia-util' => '12-31',
        );
        
        BusinessDay::enable('Illuminate\Support\Carbon', 'br-national', $feriados);
        Carbon::setHolidaysRegion('br-national');
        while ($diasUteis < $quantidadeDiasUteis) {
            $dataProposta->subDay();
            if (!$dataProposta->isBusinessDay()) {
                $dataProposta = $dataProposta->previousBusinessDay();
            }
            $diasUteis++;
        }
        return $dataProposta->format('d/m/Y');
        // $ultimoDiaUtil = DiasUteisClass::retornaPassadoEmQuantidadeDiasUteis(Carbon::now(), 1);
    }


}