<?php

//index
Route::get('', function () {
    return view('portal.index');
})->name('index');

// route 404
Route::fallback(function(){return response()->view('errors.404', [], 404);});

// sobre
Route::get('sobre', function () {
    return view('portal.informativas.sobre');
});

// area de atuação
Route::get('area', function () {
    return view('portal.informativas.area');
});

 // App Mobile
 Route::get('/app', function () {
    return view('portal.informativas.app');
});

Route::get('/teste', function () {
    $path = 'C:\Users\c098453\Desktop\Estudo';
 exec("explorer '" . $path . "'");
});

// duvidas frequentes
Route::get('faq', function () {
    return view('portal.informativas.faq');
});

// orientações
Route::get('orientacoes', function () {
    return view('portal.informativas.orientacoes');
});

// conheca o projeto
Route::get('projeto', function () {
    return view('portal.informativas.projeto');
});

// Pesquisar

Route::get('pesquisar', function () {
    return view('portal.imoveis.pesquisar');
});

//Download da Planilha Excel para controle de arquivos EMGEA
Route::get("/download/{file}", function ($file="") {
    return response()->download(storage_path("app/public/".$file));
    });


// Consulta de bem imóvel
Route::get('consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@show')->name('consulta-bem-imovel');



//  ROTAS WEB DOS PROCESSOS PERTINENTES AO ESTOQUE DE IMÓVEIS
Route::prefix('estoque-imoveis')->group(function () {
    // ROTAS API DE CONSULTA JSON
    Route::get('consulta-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@capturaDadosBaseSimov');
    Route::get('consulta-mensagens-enviadas/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaMensagensEnviadas');
    Route::get('consulta-historico-contrato/{contrato}', 'GestaoImoveisCaixa\ConsultaContratoController@consultaHistorico');

    // ROTAS DO PROJETO DE CONSULTA COM WHERE VARIAVEL (GOOGLE 2.0)
    Route::prefix('consultar-imovel')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\ConsultaContratoController@consultaImovelComWhereVariavel');
        Route::post('resultado', 'GestaoImoveisCaixa\ConsultaContratoController@pesquisaContratoComWhereVariavel');
        Route::post('resultado-LeilaoNegativo', 'GestaoImoveisCaixa\ConsultaContratoController@pesquisaContratoAbaLeilaoNegativo');
    });

    // ROTAS DO PROJETO DE DISTRATO
    Route::prefix('distrato')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\DistratoDemandaController@index');
        Route::get('consultar-dados-demanda/{contrato}', 'GestaoImoveisCaixa\DistratoDemandaController@jsonDadosDemanda');
        Route::get('listar-protocolos', 'GestaoImoveisCaixa\DistratoDemandaController@listarDemandas');
        Route::get('relacao-despesas/{distrato}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@listarRelacaoDeDespesas');
        Route::get('tratar/{contrato}', 'GestaoImoveisCaixa\DistratoDemandaController@visualizarDemanda');
        Route::post('cadastrar-demanda', 'GestaoImoveisCaixa\DistratoDemandaController@cadastrarDemanda');
        Route::post('cadastrar-despesa/{distrato}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@cadastrarDespesa');
        Route::put('alterar-demanda-distrato/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@alterarDemanda');
        Route::put('atualizar/{demanda}', 'GestaoImoveisCaixa\DistratoDemandaController@analisarDemanda');
        Route::put('atualizar-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@atualizarDespesa');
        Route::put('emitir-parecer-analista/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@emitirParecerAnalista');
        Route::put('emitir-parecer-gestor/{distrato}', 'GestaoImoveisCaixa\DistratoDemandaController@emitirParecerGestor');
        Route::get('indicadores-distrato', 'GestaoImoveisCaixa\DistratoDemandaController@indicadoresDistrato');
        Route::put('excluir-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@excluirDespesa');
        Route::put('validar-despesa/{despesa}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@validarDespesa');
        Route::get('emite-dle-despesas/{distrato}', 'GestaoImoveisCaixa\DistratoRelacaoDespesasController@emitePlanilhaDleDespesas');
    });
    
    // ROTAS DO PROJETO ACOMPANHA CONTRATACAO
    Route::prefix('acompanha-contratacao')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\AcompanhamentoContratacaoController@consultaContratosContratacaoSessentaDias');
        Route::get('listar-contratos-em-contratacao-ultimos-sessenta-dias', 'GestaoImoveisCaixa\AcompanhamentoContratacaoController@listarContratosContratacaoUltimosSessentaDias');
        Route::get('listar-contratos-sem-pagamento-sinal', 'GestaoImoveisCaixa\MonitoraPagamentoSinalController@listarContratosSemPagamentoSinal');
        Route::put('/atualizar/{idAcompanhamentoContratacao}', 'GestaoImoveisCaixa\AcompanhamentoContratacaoController@atualizaAcompanhamentoContratacao');
    });

    // ROTAS DO PROJETO DE CONFORMIDADE CONTRATACAO
    Route::prefix('conformidade-contratacao')->group(function () {
        Route::get('/', 'GestaoImoveisCaixa\ConformidadeContratataoController@index');
        Route::get('/tratamento/{contratoFormatado}', 'GestaoImoveisCaixa\ConformidadeContratataoController@tratamento');
        Route::get('listar-contratos', 'GestaoImoveisCaixa\ConformidadeContratataoController@listarContratosConformidade');
        // Route::get('emitir-proposta/{contratoFormatado}', 'GestaoImoveisCaixa\ConformidadeContratataoController@emitirPropostaContratacao');
        Route::post('registrar-historico/{contrato}', 'GestaoImoveisCaixa\ConformidadeContratataoController@registrarHistoricoConformidade');
        Route::post('/mensagem', 'GestaoImoveisCaixa\ConformidadeContratataoController@EnviodeCobrancaAgencia');
        Route::post('/mensagemPagamento', 'GestaoImoveisCaixa\ConformidadeContratataoController@EnviodeCobrancaPagamentoCliente');
    });

    // ROTAS DO PROJETO DE LEILÕES NEGATIVOS
    Route::prefix('leiloes-negativos')->group(function () {
        Route::get('', 'LeilaoNegativo\LeilaoNegativoController@viewListaLeiloesUnidade');
        Route::get('contratos/{dataSegundoLeilao}', 'LeilaoNegativo\LeilaoNegativoController@viewListaContratosSegundoLeilao');
        Route::get('listar-leiloes/{unidade}', 'LeilaoNegativo\LeilaoNegativoController@listarLeiloesUnidade');
        Route::get('listar-contratos/{dataSegundoLeilao}', 'LeilaoNegativo\LeilaoNegativoController@listarContratosLeilao');
        Route::get('cadastrar-contratos', 'LeilaoNegativo\LeilaoNegativoController@cadastrarContratosControleLeiloesNegativos');
        Route::get('tratar/{numeroContrato}', 'LeilaoNegativo\LeilaoNegativoController@viewTratarLeilaoNegativo');
        Route::put('tratar/editar-dados-contrato/{contratoFormatado}', 'LeilaoNegativo\LeilaoNegativoController@editarDadosCadastraisContratoLeilaoNegativo');
        Route::put('tratar/receber-documentos-leiloeiro/{contratoFormatado}', 'LeilaoNegativo\LeilaoNegativoController@receberDocumentosLeiloeiro');
        Route::put('tratar/entregar-documentos-despachante/{contratoFormatado}', 'LeilaoNegativo\LeilaoNegativoController@entregarDocumentosDespachante');
        Route::put('tratar/receber-protocolo-cartorio/{contratoFormatado}', 'LeilaoNegativo\LeilaoNegativoController@receberProtocoloCartorio');
        Route::put('tratar/receber-documentos-despachante/{contratoFormatado}', 'LeilaoNegativo\LeilaoNegativoController@receberDocumentosDespachante');
        Route::post('tratar/{numeroContrato}', 'LeilaoNegativo\LeilaoNegativoController@registrarHistoricoLeilaoNegativo');
        Route::get('/baixar-planilha', 'LeilaoNegativo\LeilaoNegativoController@criaPlanilhaExcelLeilaoNegativo');
        Route::get('/codigo-correio/{numeroContrato}', 'LeilaoNegativo\LeilaoNegativoController@CodigoCorreio');
        Route::post('/novo-codigo-correio', 'LeilaoNegativo\LeilaoNegativoController@SalvarCodigoCorreio');
    });

    // ROTA PARA REGISTRO DE HISTÓRICO
    Route::post('registrar-historico/{contrato}', 'GestaoImoveisCaixa\RegistroAtendimentoController@registrarHistorico');
    
    
    // ROTAS DO PROJETO DE MENSAGENS AUTOMÁTICAS
    Route::prefix('mensagens-automaticas')->group(function () {
        Route::get('autorizacao-contratacao', 'GestaoImoveisCaixa\MensagensAutomaticaAutorizacaoController@enviarMensageriasAutorizacaoContratacao');
        Route::get('autorizacao-contratacao/{contrato}', 'GestaoImoveisCaixa\MensagensAutomaticaAutorizacaoController@enviarAutorizacaoContratacaoViaPortal');
        Route::get('cobranca-contratacao/{contrato}', 'GestaoImoveisCaixa\cobrancaAndamentoProcessoController@enviarMensageria');
    });
});

// FORNECEDORES
Route::prefix('fornecedores')->group(function () {
    // DESPACHANTES
    Route::prefix('controle-despachantes')->group(function () {
        // RETORNA A VIEW DO PROJETO PARA CONTROLAR DESPACHANTES
        Route::get('/', 'Fornecedores\DespachanteController@index');
        // MÉTODO PARA CADASTRAR NOVO DESPACHANTE
        Route::post('/', 'Fornecedores\DespachanteController@cadastrarDespachante');
        // MÉTODO PARA EDITAR UM DESPACHANTE
        Route::put('/{idDespachante}', 'Fornecedores\DespachanteController@editarCadastroDespachante');
        // MÉTODO PARA DESATIVAR UM DESPACHANTE
        Route::delete('/{idDespachante}', 'Fornecedores\DespachanteController@desativarDespachante');
        // LISTAR DESPACHANTES ATIVOS DA UNIDADE
        Route::get('listar-despachantes/{codigoUnidade}', 'Fornecedores\DespachanteController@listarDespachantes');
    });
    // LEILOEIROS
    Route::prefix('controle-leiloeiros')->group(function () {
        // RETORNA A VIEW DO PROJETO PARA CONTROLAR LEILOEIROS
        Route::get('/', 'Fornecedores\LeiloeiroController@index');
        // MÉTODO PARA CADASTRAR NOVO LEILOEIRO
        Route::post('/', 'Fornecedores\LeiloeiroController@cadastrarLeiloeiro');
        // MÉTODO PARA EDITAR UM LEILOEIRO
        Route::put('/{idLeiloeiro}', 'Fornecedores\LeiloeiroController@editarCadastroLeiloeiro');
        // MÉTODO PARA DESATIVAR UM LEILOEIRO
        Route::delete('/{idLeiloeiro}', 'Fornecedores\LeiloeiroController@desativarLeiloeiro');
        // LISTAR LEILOEIRO ATIVOS DA UNIDADE
        Route::get('listar-leiloeiros/{codigoUnidade}', 'Fornecedores\LeiloeiroController@listarLeiloeiros');
    });
});

// ATENDE
Route::prefix('atende')->group(function () {  
    // CADASTRAR ATENDE
    Route::post('', 'AtendeDemandasController@cadastrarNovaDemandaAtende'); 
    // RESPONDER ATENDE
    Route::put('responder/{idAtende}', 'AtendeDemandasController@responderAtende'); 
    // REDIRECIONAR ATENDE
    Route::put('redirecionar/{idAtende}', 'AtendeDemandasController@redirecionarAtende'); 
    // LISTAR DADOS DEMANDA ATENDE
    Route::get('dados-demanda/{idAtende}', 'AtendeDemandasController@listarDadosDemandaAtende'); 
    // LISTAR ATENDES DISPONÍVEIS RESPONSÁVEL
    Route::get('listar-demandas-disponiveis', 'AtendeDemandasController@listarAtendesDisponiveisResponsavel');
    // LISTAR ATENDES DISPONÍVEIS RESPONSÁVEL ABERTURA
    Route::get('listar-demandas-agencia', 'AtendeDemandasController@listarAtendesAbertoAgencia'); 
    // LISTAR ATENDES FINALIZADOS RESPONSÁVEL ABERTURA
    Route::get('listar-demandas-finalizadas', 'AtendeDemandasController@listarAtendesFinalizadoAgencia');
    // CONTAGEM DEMANDAS DISPONÍVEIS RESPONSÁVEL (SINO)
    Route::get('contagem-demandas-disponiveis', 'AtendeDemandasController@contagemAtendesDisponiveisResponsavel'); 
    // LISTAR EQUIPES COM ATIVIDADES (MACRO E MICRO) ATENDE
    Route::get('listar-equipes-atividades-atende', 'AtendeDemandasController@listarEquipesComAtividadesAtende'); 
    // LISTAR PRAZO ATENDE UNIDADE
    Route::get('controla-prazo-atende', 'AtendeDemandasController@controlaPrazoAtende'); 
    // LISTAR TODAS AS DEMANDAS POR PRAZO
    Route::get('listar-demandas-prazo/{prazoDemanda}', 'AtendeDemandasController@listarDemandasUnidadePorPrazo');
    // MINHAS DEMANDAS
    Route::get('minhas-demandas','AtendeDemandasController@viewMinhasDemandas');
    Route::get('minhas-demandas-agencia','AtendeDemandasController@viewMinhasDemandasAgencia');
    Route::get('gestao-atende','AtendeDemandasController@viewGerenciarDemandas');
    Route::get('listar-universo','AtendeDemandasController@listarUniverso');
      // TRATAR ATENDE
    Route::get('tratar-atende/{id}','AtendeDemandasController@tratarDemanda');
});

// GERENCIAL
Route::prefix('gerencial')->group(function () {
    // GESTÃO DE EQUIPES
    Route::prefix('gestao-equipes')->group(function () {
        // RETORNA A VIEW DO PROJETO PARA CADASTRAR EQUIPES
        Route::get('/', 'GestaoEquipesController@index');
        // MÉTODO PARA CADASTRAR NOVA EQUIPE
        Route::post('/', 'GestaoEquipesController@cadastrarEquipe');
        // MÉTODO PARA EDITAR UMA EQUIPE
        Route::put('/', 'GestaoEquipesController@editarCadastroEquipe');
        // MÉTODO PARA DESATIVAR UMA EQUIPE
        Route::delete('/', 'GestaoEquipesController@desativarEquipe');
        // LISTAR GESTORES DA UNIDADE
        Route::get('listar-gestores/{codigoUnidade}', 'GestaoEquipesController@listaGestoresUnidade');
        // LISTAR GERENTE DA UNIDADE
        Route::get('listar-gerente/{codigoUnidade}', 'GestaoEquipesController@listaGerenteUnidade');
        // LISTA AS EQUIPES DE DETERMINADA UNIDADE COM OS EMPREGADOS
        Route::get('listar-equipes/{codigoUnidade}', 'GestaoEquipesController@listarEquipesUnidade');
        // LISTA DE UNIDADES
        Route::get('listar-unidades', 'GestaoEquipesController@listarUnidades');
        // DESIGNA O EMPREGADO PARA UMA EQUIPE
        Route::put('alocar-empregado', 'GestaoEquipesController@alocarEmpregadoEquipe');
        // LISTAR EMPREGADOS DA EQUIPE ATENDE
        Route::get('listar-empregados-equipe/{idEquipe}', 'GestaoEquipesController@listarEmpregadosEquipe');
    });
    
    // GESTÃO DE ATIVIDADES
    Route::prefix('gestao-atividades')->group(function () {
        // RETORNA A VIEW DO PROJETO PARA CADASTRAR ATIVIDADES
        Route::get('/', 'GestaoEquipesAtividadesController@index');
        // MÉTODO PARA CADASTRAR NOVA ATIVIDADE
        Route::post('/', 'GestaoEquipesAtividadesController@cadastrarAtividade');
        // MÉTODO PARA EDITAR ATIVIDADE
        Route::put('/{idAtividade}', 'GestaoEquipesAtividadesController@editarAtividade');
        // MÉTODO PARA DESATIVAR ATIVIDADE
        Route::delete('/{idAtividade}', 'GestaoEquipesAtividadesController@desativarAtividade');
        // MÉTODO DESIGNAR EMPREGADO NA ATIVIDADE
        Route::post('/designar-empregado-atividade', 'GestaoEquipesAtividadesController@designarEmpregadoAtividade');
        // MÉTODO PARA LISTAR AS ATIVIDADES DA UNIDADE
        Route::get('/listar-atividades/{codigoUnidade}', 'GestaoEquipesAtividadesController@listarAtividadesComResponsaveis');
    });
});

// INDICADORES
Route::prefix('indicadores')->group(function () {  
    // INDICADORES DE ACESSO
    Route::prefix('acessos')->group(function () {
        // RETORNA A VIEW DOS INDICADORES DE ACESSO
        Route::get('/', 'GestaoEquipesAtividadesController@index'); 
    });
    // RETORNA A VIEW DOS INDICADORES DE DISTRATO
    Route::get('distrato', function () {
        return view('portal.imoveis.distrato.indicadores-distrato');
    });  
});

// ROTA DE TESTE TROCA EMPREGADO CELULA
Route::match(['get', 'post', 'put', 'delete'], 'url', function (\Illuminate\Http\Request $request) {
    // dd($request);
    $resultado = rand(0, 1);
    return $resultado == 0 ? response('error', 500) : response('success', 200);
});

// ROTA PARA CADASTRAR TODOS OS EMPREGADOS DA UNIDADE (RELACIONADOS NO ARRAY) NAS TABELAS DE EMPREGADOS E GESTAO EQUIPES EMPREGADOS
Route::get('cadastra-empregados-unidade', 'CadastraEquipeTblEmpregadosTblGestaoEquipeEmpregadosController@CadastraEquipeTblEmpregadosTblGestaoEquipeEmpregadosController');

//Gestão Atende
Route::get('gerencial/gestao-atende', 'GestaoAtendeController@index');
//Listar Empregado
Route::get('gerencial/listar-empregado', 'GestaoAtendeController@listarEmpregados');
// REDIRECIONAMENTO DO GESTOR
Route::put('redirecionar/gestor/{idAtende}', 'GestaoAtendeController@redirecionarAtendeGestor');
// RESPONDER ATENDE GESTOR
Route::put('responder/gestor/{idAtende}', 'GestaoAtendeController@responderAtendeGerencial');
// EXCLUIR ATENDE GESTOR
Route::put('excluir/gestor/{idAtende}', 'GestaoAtendeController@excluirAtendeGerencial');  

// ROTA CONTROLE ARQUIVO EMGEA
Route::get('/controle-arquivos', 'PlaniladeControle\UploadexcelController@importaExcel');
Route::post('/controle-arquivos/envia', 'PlaniladeControle\UploadexcelController@import');
Route::get('/controle-arquivos/lista', 'PlaniladeControle\UploadexcelController@listaUpload');
Route::get('/controle-arquivos/baixar', 'PlaniladeControle\DownloadexcelController@criaPlanilhaControleExcel');

//ROTA DO ATENDE GENERICO
Route::get('gerencial/gerenciar-atende-generico', 'FaleConoscoController@AtendeGenericoIndex');
Route::get('atende/abrir', 'FaleConoscoController@cadastrarAtendeGenericoIndex');
Route::post('gerencial/cadastra-atividade-generica', 'FaleConoscoController@cadastrarAtividadeGenerica');
Route::put('gerencial/editar-atividade-generica/{id}', 'FaleConoscoController@editarAtividadeGenerica');
Route::put('gerencial/excluir-atividade-generica/{id}', 'FaleConoscoController@apagarFaleConosco');
Route::put('fale-conosco/responder/{id}', 'FaleConoscoController@responderFaleConosco');
Route::put('fale-conosco/excluir/{id}', 'FaleConoscoController@excluirFaleConoscoAgencia');
Route::get('atende/lista-atende-generico', 'FaleConoscoController@listademandasgenericas');
Route::get('atende/lista-atende-generico/{gilie}', 'FaleConoscoController@listademandaporgilie');
Route::get('atende/lista-atende-faleConosco', 'FaleConoscoController@listaFaleConosco');
Route::post('fale-conosco/abrir', 'FaleConoscoController@cadastrarNovaDemandaAtendeGenerica');
Route::get('atende/{gilie}', 'FaleConoscoController@abrirdemandaporgilie');
Route::delete('gerencial/apagar-demanda-generica/{id}', 'FaleConoscoController@apagarAtividadeGenerica');
Route::get('gerencial/gerenciar-fale-conosco/lista', 'FaleConoscoController@ListaFaleConoscoGerencial');
Route::get('listar/atende-sem-contrato-agencia', 'FaleConoscoController@listaFaleConoscoagencia');
Route::get('listar/atende-sem-contrato-finalizado', 'FaleConoscoController@listaFaleConoscoagenciaFinalizado');

//ROTA controle de laudo
Route::get('controle-laudos', 'Laudo\controleLaudoController@controleLaudoIndex');
//traz universo laudo
Route::get('controle-laudos/universo', 'Laudo\controleLaudoController@universoLaudo');
//traz universo vencido
Route::get('controle-laudos/laudo-vencido', 'Laudo\controleLaudoController@laudoVencido');
//Em Reavaliacao
Route::get('controle-laudos/reavaliacao', 'Laudo\controleLaudoController@laudoEmReavaliacao');
//Em Pendencia
Route::get('controle-laudos/em-pendencia', 'Laudo\controleLaudoController@laudoEmPendencia');
//Altera dados
Route::post('controle-laudos/alterar/{id}', 'Laudo\controleLaudoController@cadastrarAlteracoes');
//Envia Mensageria
Route::post('controle-laudos/envia-mensagem/{id}', 'Laudo\controleLaudoController@enviaMensagem');
//Cria Excel para Download
Route::get('controle-laudos/download-excel', 'Laudo\controleLaudoController@criaPlanilhaExcelLaudo');
//cadastra OS
Route::post('controle-laudos/cadastrarOS', 'Laudo\controleLaudoController@cadastrarOS');
//cadastra OBS
Route::post('controle-laudos/cadastrarobs/{id}', 'Laudo\controleLaudoController@cadastrarOBS');
//view de baixa
Route::get('controle-laudos/controle-baixa', 'Laudo\controleLaudoController@baixaDeLaudo');
//view de correcao
Route::get('controle-laudos/controle-correcao', 'Laudo\controleLaudoController@correcaoDeLaudo');
Route::get('controle-laudos/correcao', 'Laudo\controleLaudoController@laudoEmCorrecao');


//ROTA Corretores
Route::get('corretores', 'CorretoresController@Corretores');
// lista corretores
Route::get('corretores/lista-corretores', 'CorretoresController@listaCorretores');