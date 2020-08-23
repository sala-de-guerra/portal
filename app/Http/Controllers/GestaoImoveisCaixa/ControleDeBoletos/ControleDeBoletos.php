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
        ->whereRaw('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.TOTAL_PROPOSTA > CUB_056_PAGAMENTOS_BOLETOS_SIMOV.RECURSOS_PROPRIOS')
        ->whereNotNull('PAGO')
        ->whereNotNull('SITUAÇÃO')
        ->get();

         return json_encode($boletosAvista);
        
    }

    public function enviaMensageriaGILIES()
    {
        $ultimoDiaUtil = DiasUteisClass::retornaPassadoEmQuantidadeDiasUteis(Carbon::now(), 1);

        $boletosFinanciadosOntem = DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
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
        ->whereNotNull('PAGO')
        ->whereNotNull('SITUAÇÃO')
        ->orderBy('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', 'asc')
        ->get();
        
        $boletosPagosOntem = [];
         foreach ($boletosFinanciadosOntem as $boleto){
            if ($boleto->dataPagamento == $ultimoDiaUtil){
              array_push($boletosPagosOntem, $boleto );

              //converte valor do pagamento padrão SQL em R$ 
              if (strpos($boleto->valorPagamento, "0") == 0){
                $boleto->valorPagamento = str_replace(',', '.',$boleto->valorPagamento);
                    $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');
                }else{
                    $boleto->valorPagamento = str_replace('.', '', $boleto->valorPagamento);
                    $boleto->valorPagamento = str_replace(',', '.', $boleto->valorPagamento);
                    $boleto->valorPagamento = number_format($boleto->valorPagamento, 2, ',', '.');            
            }
              
              $historico = new HistoricoPortalGilie;
              $historico->matricula       = session('matricula');
              $historico->numeroContrato  = $boleto->contratoFormatado;
              $historico->tipo            = "PAGAMENTO DE BOLETO";
              $historico->atividade       = "CONTRATAÇÃO";
              $historico->observacao      = "PAGAMENTO DO BOLETO: Proponente - " . $boleto->proponente .  "NO VALOR DE: " . "R$".$boleto->valorPagamento;
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
                       </tr>";   
            $tabelaDeBoletosPagos .= $linha;
            }
          $mensagem = file_get_contents(("mensagemDeBoletos.php"), dirname(__FILE__));
          $mensagem = str_replace("%listagem_de_Contratos%", $tabelaDeBoletosPagos, $mensagem);
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
            $mail->addAddress('giliebh@caixa.gov.br');
            $mail->addAddress('giliebu@caixa.gov.br');
            $mail->addAddress('giliebe@caixa.gov.br');
            $mail->addAddress('giliebr@caixa.gov.br');
            $mail->addAddress('giliect@caixa.gov.br');
            $mail->addAddress('giliefo@caixa.gov.br');
            $mail->addAddress('giliego@caixa.gov.br');
            $mail->addAddress('giliepo@caixa.gov.br');
            $mail->addAddress('gilierj@caixa.gov.br');
            $mail->addAddress('giliere@caixa.gov.br');
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
}

