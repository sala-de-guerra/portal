<?php

namespace App\Http\Middleware;

use Closure;

class ValidaAcessoRotaPortal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('codigoLotacaoFisica') == null || $request->session()->get('codigoLotacaoFisica') === "NULL") {
            $lotacao = $request->session()->get('codigoLotacaoAdministrativa');
        } else {
            $lotacao = $request->session()->get('codigoLotacaoFisica');
        }

        switch(preg_replace('/[0-9]+/', '', $request->path())) {
            
            // ROTAS DE ACESSO EXCLUSIVO PARA NOSSA UNIDADE
            // case 'controle-conformidade':
            case 'estoque-imoveis/distrato':
            case 'estoque-imoveis/distrato/alterar-demanda-distrato':
            case 'estoque-imoveis/distrato/atualizar-despesa':
            case 'estoque-imoveis/distrato/atualizar/':
            case 'estoque-imoveis/distrato/cadastrar-demanda':
            case 'estoque-imoveis/distrato/cadastrar-despesa/':
            case 'estoque-imoveis/distrato/emitir-parecer-analista/':
            case 'estoque-imoveis/distrato/emitir-parecer-gestor/':
            case 'estoque-imoveis/distrato/excluir-despesa/':
            case 'estoque-imoveis/distrato/tratar/':
            case 'estoque-imoveis/distrato/validar-despesa/':
            case 'estoque-imoveis/mensagens-automaticas/autorizacao-contratacao':
            case 'estoque-imoveis/mensagens-automaticas/autorizacao-contratacao/':
            case 'estoque-imoveis/registrar-historico/':
            case 'estoque-imoveis/conformidade-contratacao':
            case 'estoque-imoveis/acompanha-contratacao':
            case 'estoque-imoveis/monitora-pagamento-sinal':
            case 'indicadores/distrato':
                if (!in_array(session()->get('acessoEmpregadoPortal'), ['GESTOR', env('NOME_NOSSA_UNIDADE'), 'DESENVOLVEDOR'])) {
                    $request->session()->flash('corMensagem', 'warning');
                    $request->session()->flash('tituloMensagem', "Acesso negado!");
                    $request->session()->flash('corpoMensagem', "Você não tem perfil para acessar essa página.");
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
