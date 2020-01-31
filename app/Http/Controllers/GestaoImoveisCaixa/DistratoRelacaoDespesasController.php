<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\GestaoImoveisCaixa\DistratoDemanda;
use App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas;
use App\Models\HistoricoPortalGilie;
use App\Models\BaseSimov;
use App\Models\PropostasSimov;
use App\Models\ControleMensageria;
use App\Models\RelacaoAgSrComEmail;
use App\Exports\PlanilhaDespesasDistratoDle;
use Maatwebsite\Excel\Facades\Excel;

class DistratoRelacaoDespesasController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $demandaDistrato
     * @return \Illuminate\Http\Response
     */
    public function cadastrarDespesa(Request $request, $idDistrato)
    {
        try {
            DB::beginTransaction();
            $dadosDistrato = DistratoDemanda::where('idDistrato', $idDistrato)->first();

            // AJUSTA A DATA EFETIVA DA DESPESA PARA REGISTRAR NO BANCO
            $dataEfetivaDaDespesa = substr($request->dataEfetivaDaDespesa, 6, 4) . '-' . substr($request->dataEfetivaDaDespesa, 3, 2) . '-' . substr($request->dataEfetivaDaDespesa, 0, 2);
            
            // CADASTRA NOVA DESPESA            
            $novaDespesa = new DistratoRelacaoDespesas;
            $novaDespesa->idDistrato = $idDistrato;
            $novaDespesa->tipoDespesa = $request->tipoDespesa;
            $novaDespesa->valorDespesa = str_replace(',', '.', str_replace('.', '', $request->valorDespesa));
            $novaDespesa->dataEfetivaDaDespesa = $dataEfetivaDaDespesa;
            $novaDespesa->devolucaoPertinente = 'SIM';
            $novaDespesa->excluirDespesa = 'NAO';
            $novaDespesa->observacaoDespesa = $request->observacaoDespesa;
            $novaDespesa->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Despesa cadastrada!");
            $request->session()->flash('corpoMensagem', "A despesa #" . str_pad($novaDespesa->idDespesa, 4, '0', STR_PAD_LEFT) . " foi cadastrada com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro de despesa não foi efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro da despesa. Tente novamente");
        }
        return redirect('/estoque-imoveis/distrato/tratar/' . $dadosDistrato->contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idDespesa
     * @return \Illuminate\Http\Response
     */
    public function atualizarDespesa(Request $request, $idDespesa)
    {       
        try {
            DB::beginTransaction();
            // AJUSTA A DATA EFETIVA DA DESPESA PARA REGISTRAR NO BANCO
            $dataEfetivaDaDespesa = substr($request->dataEfetivaDaDespesa, 6, 4) . '-' . substr($request->dataEfetivaDaDespesa, 3, 2) . '-' . substr($request->dataEfetivaDaDespesa, 0, 2);

            // ATUALIZA DEMANDA          
            $despesa = DistratoRelacaoDespesas::where('idDespesa', $idDespesa)->first();
            $despesa->tipoDespesa = $request->tipoDespesa == null ? $despesa->tipoDespesa : $request->tipoDespesa;
            $despesa->valorDespesa = str_replace(',', '.', str_replace('.', '', $request->valorDespesa));
            $despesa->dataEfetivaDaDespesa =  $dataEfetivaDaDespesa;
            $despesa->observacaoDespesa = $request->observacaoDespesa != null ? $request->observacaoDespesa : $despesa->observacaoDespesa;

            // CARREGA OS DADOS DA DEMANDA DE DISTRATO PARA USAR O NUMERO DO CONTRATO NO REDIRECT
            $dadosDistrato = DistratoDemanda::where('idDistrato', $despesa->idDistrato)->first(); 

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Despesa atualizada!");
            $request->session()->flash('corpoMensagem', "A despesa #" . str_pad($despesa->idDistrato, 4, '0', STR_PAD_LEFT) . " foi atualizada com sucesso.");

            // PERSISTE OS DADOS NO FIM DO MÉTODO 
            $despesa->save();
            DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Despesa não atualizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a atualização da despesa. Tente novamente");
        }
        return redirect('/estoque-imoveis/distrato/tratar/' . $dadosDistrato->contratoFormatado);
    }

    /**
     *
     * @param  int  $idDistrato
     * @return \Illuminate\Http\Response
     */
    public function listarRelacaoDeDespesas($idDistrato)
    {
        $relacaoDespesasDaDemandaDeDistrato = DistratoRelacaoDespesas::where('idDistrato', $idDistrato)->where('excluirDespesa', 'NAO')->get();
        return json_encode($relacaoDespesasDaDemandaDeDistrato);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idDespesa
     * @return \Illuminate\Http\Response
     */
    public function excluirDespesa(Request $request, $idDespesa)
    {       
        try {
            DB::beginTransaction();
            // ATUALIZA DEMANDA          
            $despesa = DistratoRelacaoDespesas::where('idDespesa', $idDespesa)->first();
            $despesa->devolucaoPertinente = 'NAO';
            $despesa->excluirDespesa = 'SIM';

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Despesa excluida!");
            $request->session()->flash('corpoMensagem', "A despesa #" . str_pad($despesa->idDespesa, 4, '0', STR_PAD_LEFT) . " foi excluida com sucesso.");

            $dadosDistrato = DistratoDemanda::where('idDistrato', $despesa->idDistrato)->first();

            // PERSISTE OS DADOS NO FIM DO MÉTODO 
            $despesa->save();
            DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Despesa não atualizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a atualização da despesa. Tente novamente");
        }
        return redirect('/estoque-imoveis/distrato/tratar/' . $dadosDistrato->contratoFormatado);
    }
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idDespesa
     * @return \Illuminate\Http\Response
     */
    public function validarDespesa(Request $request, $idDespesa)
    {       
        try {
            DB::beginTransaction();

            // ATUALIZA DESPESA
            $despesa = DistratoRelacaoDespesas::find($idDespesa);
            $despesa->devolucaoPertinente = $request->input('devolucaoPertinente') == null ? $despesa->devolucaoPertinente : $request->input('devolucaoPertinente');

            // CAPTURA DADOS DISTRATO
            $dadosDistrato = DistratoDemanda::where('idDistrato', $despesa->idDistrato)->first();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Despesa atualizada!");
            $request->session()->flash('corpoMensagem', "O status da demanda foi atualizada com sucesso.");

            // SÓ PERSISTE OS DADOS NO BANCO NO FIM DO MÉTODO
            $despesa->save();
            DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Despesa não atualizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a atualização da despesa. Tente novamente");
        }
        return redirect("/estoque-imoveis/distrato/tratar/" . $dadosDistrato->contratoFormatado);
    }

    /**
     *
     * @param  int  $idDistrato
     * @return \Illuminate\Http\Response
     */
    public static function emitePlanilhaDleDespesas($idDistrato)
    {
        // dd('parou');
        ob_end_clean(); // this
        ob_start(); // and this
        // dd($planilha);
        return Excel::download(new PlanilhaDespesasDistratoDle($idDistrato), 'DLE.xls');
    }
}