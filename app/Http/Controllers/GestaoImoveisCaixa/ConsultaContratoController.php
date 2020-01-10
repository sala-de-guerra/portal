<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoricoPortalGilie;
use App\Models\ControleMensageria;

class ConsultaContratoController extends Controller
{
    static public function consultaMensagensEnviadas($numeroContrato)
    {
        $universoMensagensEnviadas = ControleMensageria::where('numeroContrato', $numeroContrato)->get();
        $jsonMensagensEnviadas = [];
        foreach ($universoMensagensEnviadas as $mensagem) {
            $arrayDadosMensagem = [
                'tipoMensagem' => $mensagem->tipoMensagem,
                'codigoAgencia' => $mensagem->codigoAgencia,
                'emailProponente' => $mensagem->emailProponente,
                'emailCorretor' => $mensagem->emailCorretor,
                'dataEnvio' => $mensagem->created_at,
            ];
            array_push($jsonMensagensEnviadas, $arrayDadosMensagem);
        }
        $jsonMensagensEnviadas = ['mensagens' => $jsonMensagensEnviadas];

        return json_encode($jsonMensagensEnviadas);
    }

    static public function consultaHistorico($numeroContrato)
    {
        $universoHistoricoContrato = HistoricoPortalGilie::where('numeroContrato', $numeroContrato)->get();
        $jsonHistoricoContrato = [];
        foreach ($universoHistoricoContrato as $historico) {
            $arrayDadosHistorico = [
                'matriculaResponsavel' => $historico->matricula,
                'tipo' => $historico->tipo,
                'atividade' => $historico->atividade,
                'observacao' => $historico->observacao,
                'data' => $historico->created_at,
            ];
            array_push($jsonHistoricoContrato, $arrayDadosHistorico);
        }
        $jsonHistoricoContrato = ['historico' => $jsonHistoricoContrato];
        
        return json_encode($jsonHistoricoContrato);
    }
}
