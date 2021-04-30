<?php


namespace App\Http\Controllers\VILOP;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\Vilop\PesquisaColaboradores;


class produtividadeColaboradores extends Controller
{
    public function view()
    {
        $nome = ucfirst(strtolower(session('primeiroNome')));
        $codigoUnidadeUsuarioSessao = str_pad(Ldap::defineUnidadeUsuarioSessao(), 4, '0', STR_PAD_LEFT);
        $siglaUnidadeUsuarioSessao = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $codigoUnidadeUsuarioSessao)->first();
        $procuraUnidadeResposta= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->join('produtividade.TB_MACROPROCESSOS', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'))
        ->where('TB_MACROPROCESSOS.IC_ATIVO', 1)
        ->where('NU_CGC', $codigoUnidadeUsuarioSessao)
        ->first();
        $unidadeCGC =  $codigoUnidadeUsuarioSessao;
        if(is_object($procuraUnidadeResposta)){
            return view('portal.produtividade-vilop.pesquisa-colaborador.pesquisa-colaborador', [
                'unidadeCGC' => $unidadeCGC,
                'sigla'      => $siglaUnidadeUsuarioSessao->Sigla,
                'nome'       => $nome
            ]);
        }else{
            return view('portal.produtividade-vilop.pesquisa-colaborador.unidade-sem-pesquisa', [
                'unidadeCGC' => $unidadeCGC,
                'sigla'      => $siglaUnidadeUsuarioSessao->Sigla,
                'nome'       => $nome
            ]);
        }  

    }

    public function viewUnidadeDiferente($cgc)
    {
        $nome = ucfirst(strtolower(session('primeiroNome')));
        $siglaUnidadeUsuarioSessao = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $cgc)->first();
        $procuraUnidadeResposta= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->join('produtividade.TB_MACROPROCESSOS', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'))
        ->where('TB_MACROPROCESSOS.IC_ATIVO', 1)
        ->where('NU_CGC', $cgc)
        ->first();
        $unidadeCGC =  $cgc;
        if(is_object($procuraUnidadeResposta)){
            return view('portal.produtividade-vilop.pesquisa-colaborador.pesquisa-colaborador', [
                'unidadeCGC' => $unidadeCGC,
                'sigla'      => $siglaUnidadeUsuarioSessao->Sigla,
                'nome'       => $nome
            ]);
        }else{
            return view('portal.produtividade-vilop.pesquisa-colaborador.unidade-sem-pesquisa', [
                'unidadeCGC' => $unidadeCGC,
                'sigla'      => $siglaUnidadeUsuarioSessao->Sigla,
                'nome'       => $nome
            ]);
        }  

    }

    public function listaProcessoColaboradores($cgc)
{
    $listaMicroProcessoNovo= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->leftjoin('produtividade.TB_MICROPROCESSO', DB::raw('CONVERT(VARCHAR, produtividade.TB_MICROPROCESSO.ID_MICRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO)')) 
        ->leftjoin('produtividade.TB_MACROPROCESSOS', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'))       
        ->select(DB::raw("
        produtividade.TB_MICROPROCESSO.[DE_MICRO] as nomeMicroatividade,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_MICRO] as idMicro,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_MACRO] as idMacro,
        produtividade.TB_MACROPROCESSOS.[DE_MACRO] as nomeMacroatividade
        "))
        ->where('produtividade.TB_MICROPROCESSO.IC_MENSURAVEL', '=', 'S')
        ->where('TB_RELACAO_CGC_MACRO_MICRO.NU_CGC', '=', $cgc)
        ->where('TB_RELACAO_CGC_MACRO_MICRO.IC_ATIVO', '=',1)
        ->get();

    return json_encode($listaMicroProcessoNovo);
}

public function listaMicroProcessoColaboradoresPorColaborador($cgc)
{
    $listaMicroProcessoNovo= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->join('produtividade.TB_MICROPROCESSO', DB::raw('CONVERT(VARCHAR, produtividade.TB_MICROPROCESSO.ID_MICRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO)'))    
        ->join('produtividade.TB_PESQUISA_COLABORADOR', DB::raw('CONVERT(VARCHAR, produtividade.TB_PESQUISA_COLABORADOR.idMicro)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO)'))        
        ->select(DB::raw("
        produtividade.TB_MICROPROCESSO.[DE_MICRO] as nomeMicroatividade,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_MICRO] as idMicro,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_MACRO] as idMacro,
        produtividade.TB_PESQUISA_COLABORADOR.[idPesquisaColaborador] as idPesquisaColaborador
        "))
        ->where('produtividade.TB_MICROPROCESSO.IC_MENSURAVEL', '=', 'S')
        ->where('TB_RELACAO_CGC_MACRO_MICRO.NU_CGC', '=', $cgc)
        ->where('TB_RELACAO_CGC_MACRO_MICRO.IC_ATIVO', '=',1)
        ->where('TB_PESQUISA_COLABORADOR.matricula', '=',session('matricula'))
        ->distinct('idMicro')
        ->get();

    return json_encode($listaMicroProcessoNovo);
}

public function respondeMicroProcessoColaboradores(Request $request)
{
    $respondeMicroProcessoColaboradores                                       = new PesquisaColaboradores;
    $respondeMicroProcessoColaboradores->matricula                            = session('matricula');
    $respondeMicroProcessoColaboradores->dataResposta                         = date("Y-m-d H:i:s", time());
    $respondeMicroProcessoColaboradores->codigoLotacaoAdministrativa          = session('codigoLotacaoAdministrativa');
    $respondeMicroProcessoColaboradores->codigoLotacaoFisica                  = session('codigoLotacaoFisica');
    $respondeMicroProcessoColaboradores->codigoUnidadeResposta                = $request->unidade;
    $respondeMicroProcessoColaboradores->idMicro                              = $request->idMicro;
    $respondeMicroProcessoColaboradores->tempoAtividadeMinutos                = $request->quantidadeHoras;
    $respondeMicroProcessoColaboradores->save();

    return redirect('/produtividade-vilop/pesquisa/colaborador');
}

}