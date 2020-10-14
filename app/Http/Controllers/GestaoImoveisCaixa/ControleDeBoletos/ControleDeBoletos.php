<?php

namespace App\Http\Controllers\GestaoImoveisCaixa\ControleDeBoletos;

use App\Classes\Ldap;
use App\Http\Controllers\Controller;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Classes\DiasUteisClass;
use App\Models\HistoricoPortalGilie;
use PHPMailer\PHPMailer\PHPMailer;
use App\Exports\criaExcelPlanilhadeBoletos;
use Maatwebsite\Excel\Facades\Excel;

class ControleDeBoletos extends Controller
{
    public function index()
    {
        return view('portal.imoveis.contratacao.controle-boletos');
    }

    public function listaDadosBoleto($id)
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $boletosAvista= DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
        ->leftjoin('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
        ->select(DB::raw("
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
        ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALIDADE] as validade,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[EMISSAO] as emissao,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[BANCO] as banco,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[RECURSO] as tipo,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento
      "))
        ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM', $id)
        ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.VALIDADE', 'desc')
        ->get();

         return json_encode($boletosAvista);
        
    }

    public function listaUniversoAvista()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $boletosAvista= DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
        ->leftjoin('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
        ->select(DB::raw("
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
        ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento
      "))
        ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', $codigoUnidadeUsuarioSessao)
        ->whereRaw('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.TOTAL_PROPOSTA = CUB_056_PAGAMENTOS_BOLETOS_SIMOV.RECURSOS_PROPRIOS')
        ->whereNotNull('PAGO')
        ->whereNotNull('SITUAÇÃO')
        ->get();

         return json_encode($boletosAvista);
        
    }

    public function listaUniversoFinanciamento()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $boletosFinanciamento= DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
        ->leftjoin('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
        ->select(DB::raw("
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
        ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento
      "))
        ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', $codigoUnidadeUsuarioSessao)
        ->whereRaw('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.TOTAL_PROPOSTA > CUB_056_PAGAMENTOS_BOLETOS_SIMOV.RECURSOS_PROPRIOS')
        ->whereNotNull('PAGO')
        ->whereNotNull('SITUAÇÃO')
        ->get();

         return json_encode($boletosFinanciamento);
        
    }

    public function enviaMensageriaGILIES()
    {
        $ultimoDiaUtil = DiasUteisClass::retornaPassadoEmQuantidadeDiasUteis(Carbon::now(), 1);

        //GILIE/SP - 7257
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7257')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7257')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliesp01@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE-BH - 7244 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7244')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7244')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliebh@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/BU - 7242 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7242')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7242')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliebu@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();
            
            //GILIE/BE - 7243 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7243')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7243')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliebe@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/BR - 7109 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7109')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7109')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliebr@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();
           
            //GILIE/CT - 7247 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7247')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7247')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliect@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/FO - 7248 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7248')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7248')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliefo@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/GO - 7249 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7249')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7249')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliego@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/PO - 7251 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7251')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7251')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliepo@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/RJ - 7254
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7254')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7254')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('gilierj@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/RE - 7253 
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7253')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7253')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliere@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

            //GILIE/SA - 7255
            $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
            ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento,
            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as totalProposta

          "))
            ->whereNotNull('PAGO')
            ->whereNotNull('SITUAÇÃO')
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7255')
            ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
            ->get();

            $boletosCanceladosOntem = DB::table('TBL_VENDAS_CANCELADAS')
            ->leftjoin('CUB_056_PAGAMENTOS_BOLETOS_SIMOV', 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM',  "=", 'TBL_VENDAS_CANCELADAS.NU_BEM')
            ->select(DB::raw("
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilieDoCancelamento,
            TBL_VENDAS_CANCELADAS.[BEM_FORMATADO] as NumeroBemFormatado,
            CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponenteCancelamento,
            TBL_VENDAS_CANCELADAS.[STATUS_BOLETO] as statusCancelamento
          "))
            ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', '7255')
            ->distinct('TBL_VENDAS_CANCELADAS.DATA_PROPOSTA', 'BEM_FORMATADO')
            ->get();

            $tabelaDeBoletosCancelados = "";
            foreach ($boletosCanceladosOntem as $boletoCancelado){
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boletoCancelado->NumeroBemFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO CANCELADO: Proponente - " . $boletoCancelado->proponenteCancelamento .  " - MOTIVO: " .$boletoCancelado->statusCancelamento;
              $historico->created_at      = date("Y-m-d H:i:s", time());
              $historico->updated_at      = date("Y-m-d H:i:s", time());
              $historico->save();

              $linhaCancelado = "<tr>
                                 <td>" .$boletoCancelado->gilieDoCancelamento .     "</td>
                                 <td>" . $boletoCancelado->NumeroBemFormatado .     "</td>
                                 <td>" . $boletoCancelado->proponenteCancelamento . "</td>
                                 <td>" . $boletoCancelado->statusCancelamento .     "</td>
                                 </tr>";   
                                  $tabelaDeBoletosCancelados .= $linhaCancelado;
            }
            
            $boletosPagosOntem = [];
             foreach ($boletosFinanciadosOntem as $boleto){
                if ($boleto->dataPagamento == $ultimoDiaUtil){
                  array_push($boletosPagosOntem, $boleto );
    
                  //converte valor do pagamento padrão SQL em R$ 
                  if (strpos($boleto->valorPagamento, "0") == 0){
                        $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');

                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                    }else{
                        $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                        $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                        $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                        
                        $boleto->totalProposta = str_replace(',', '.',$boleto->totalProposta);
                        $boleto->totalProposta = number_format($boleto->totalProposta, 2, ',', '.');
                }
                  
                  $historico = new HistoricoPortalGilie;
                  $historico->matricula       = session('matricula');
                  $historico->numeroContrato  = $boleto->contratoFormatado;
                  $historico->tipo            = "PAGAMENTO DE BOLETO";
                  $historico->atividade       = "CONTRATAÇÃO";
                  $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  " - NO VALOR DE: " . "R$".$boleto->valorPagamento;
                  $historico->created_at      = date("Y-m-d H:i:s", time());
                  $historico->updated_at      = date("Y-m-d H:i:s", time());
                  $historico->save();
                }
            
              }
              $tabelaDeBoletosPagos = "";
              foreach ($boletosPagosOntem as $boletoPago){
               $linha = "<tr>
                               <td>" .$boletoPago->gilie . "</td>
                               <td>" . $boletoPago->contratoFormatado . "</td>
                               <td>" . $boletoPago->proponente . "</td>
                               <td>" ."R$ " . $boletoPago->valorPagamento . "</td>
                               <td>" ."R$ " . $boletoPago->totalProposta . "</td>
                           </tr>";   
                $tabelaDeBoletosPagos .= $linha;
                }
              $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
              $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
              $mensagem = str_replace("%listagem_de_cancelados%", $tabelaDeBoletosCancelados, $mensagem);
              $mensagem = str_replace("%dia_anterior%", $ultimoDiaUtil, $mensagem);
              
              $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                // $mail->addAddress('c098453@mail.caixa');
                $mail->addAddress('giliesa@caixa.gov.br');
                $mail->addBCC('GILIESP09@caixa.gov.br');
                
                $mail->Subject = 'Aviso de boletos pagos';
                $mail->Body = $mensagem;
                $mail->send();

          return redirect("/contratacao/controle-boletos");   
        }
         
         public function listaPagamentosNovos()
         {
          $ultimoDiaUtil = DiasUteisClass::retornaPassadoEmQuantidadeDiasUteis(Carbon::now(), 1);

             $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
             $boletosAvista= DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
             ->leftjoin('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
             ->select(DB::raw("
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
             ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO] as valorBoleto,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO] as valorPagamento,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[TOTAL_PROPOSTA] as totalProposta,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
             CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento
           "))
           ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', $codigoUnidadeUsuarioSessao)
             ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.PAGAMENTO', $ultimoDiaUtil)
             ->whereNotNull('PAGO')
             ->whereNotNull('SITUAÇÃO')
             ->get();
     
              return json_encode($boletosAvista);
             
         }

         public function criaPlanilhaControleBoletos()
    {

        return Excel::download(new criaExcelPlanilhadeBoletos, 'PlanilhadeBoletos.xlsx');
    }

}

