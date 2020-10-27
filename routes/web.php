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
        Route::get('listar-data-conformidade', 'GestaoImoveisCaixa\ConformidadeContratataoController@listaDataConformidade');
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
    // LISTAR ATENDES FINALIZADOS RESPONSÁVEL
    Route::get('demandas-finalizadas-responsavel', 'AtendeDemandasController@listarAtendesFinalizadoResponsavel');
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
    // criar modelo de mensagem
    Route::post('criar-mensagem','AtendeDemandasController@criaModeloMensagem');
    // lista modelos de mensagem
    Route::get('apagar-mensagem/{id}','AtendeDemandasController@apagarModeloMensagem');
    // lista modelos de mensagem
    Route::get('lista-mensagem','AtendeDemandasController@listarModeloMensagem');
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
//Gestão Atende por dias de vencimento
Route::get('gerencial/gestao-atende-porVencimento', 'GestaoAtendeController@visaoDiasDeVencimento');
//Listar Empregado
Route::get('gerencial/listar-empregado', 'GestaoAtendeController@listarEmpregados');
// REDIRECIONAMENTO DO GESTOR
Route::put('redirecionar/gestor/{idAtende}', 'GestaoAtendeController@redirecionarAtendeGestor');
// RESPONDER ATENDE GESTOR
Route::put('responder/gestor/{idAtende}', 'GestaoAtendeController@responderAtendeGerencial');
// EXCLUIR ATENDE GESTOR
Route::put('excluir/gestor/{idAtende}', 'GestaoAtendeController@excluirAtendeGerencial'); 
// LISTAR UNIVERSO ATENDE
Route::get('gerencial/listar-atende', 'GestaoAtendeController@listarUniverso');
// LISTAR FINALIZADOS
Route::get('gerencial/listar-finalizados', 'GestaoAtendeController@listarFinalizados'); 

// ROTA CARGA EM LOTE EMGEA
Route::get('carga-em-lote/controle-arquivos', 'PlaniladeControle\UploadexcelController@importaExcel');
Route::post('/controle-arquivos/envia', 'PlaniladeControle\UploadexcelController@import');
Route::get('/controle-arquivos/lista', 'PlaniladeControle\UploadexcelController@listaUpload');
Route::get('/controle-arquivos/baixar', 'PlaniladeControle\DownloadexcelController@criaPlanilhaControleExcel');
// ROTA CARGA EM LOTE AVERBAÇÃO LEILÃO NEGATIVO
Route::get('carga-em-lote/averbacao-leilao-negativo', 'LeilaoNegativo\cargaAverbacaoController@importaExcelAverbacao');
Route::post('/carga-em-lote/averbacao-leilao-negativo/envia', 'LeilaoNegativo\cargaAverbacaoController@import');

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
Route::get('preparar-e-ofertar/controle-laudos', 'Laudo\controleLaudoController@controleLaudoIndex');
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
Route::post('preparar-e-ofertar/controle-laudos/envia-mensagem/{id}', 'Laudo\controleLaudoController@enviaMensagem');
//Cria Excel para Download
Route::get('preparar-e-ofertar/controle-laudos/download-excel', 'Laudo\controleLaudoController@criaPlanilhaExcelLaudo');
//cadastra OS
Route::post('preparar-e-ofertar/controle-laudos/cadastrarOS', 'Laudo\controleLaudoController@cadastrarOS');
//cadastra OBS
Route::post('controle-laudos/cadastrarobs/{id}', 'Laudo\controleLaudoController@cadastrarOBS');
//view de baixa
Route::get('preparar-e-ofertar/controle-laudos/controle-baixa', 'Laudo\controleLaudoController@baixaDeLaudo');
//view de correcao
Route::get('preparar-e-ofertar/controle-laudos/controle-correcao', 'Laudo\controleLaudoController@correcaoDeLaudo');
Route::get('controle-laudos/correcao', 'Laudo\controleLaudoController@laudoEmCorrecao');


//ROTA Corretores view
Route::get('corretores', 'CorretoresController@Corretores');
// lista corretores GILIE SP
Route::get('corretores/lista-corretores', 'CorretoresController@listaCorretores');
// lista corretores GILIE SA
Route::get('corretores/lista-corretores-sa', 'CorretoresController@listaCorretoresSA');
// lista corretores GILIE RE
Route::get('corretores/lista-corretores-re', 'CorretoresController@listaCorretoresRE');
// lista corretores GILIE RJ
Route::get('corretores/lista-corretores-rj', 'CorretoresController@listaCorretoresRJ');
// lista corretores GILIE PO
Route::get('corretores/lista-corretores-po', 'CorretoresController@listaCorretoresPO');
// lista corretores GILIE GO
Route::get('corretores/lista-corretores-go', 'CorretoresController@listaCorretoresGO');
// lista corretores GILIE FO
Route::get('corretores/lista-corretores-fo', 'CorretoresController@listaCorretoresFO');
// lista corretores GILIE CT
Route::get('corretores/lista-corretores-ct', 'CorretoresController@listaCorretoresCT');
// lista corretores GILIE BR
Route::get('corretores/lista-corretores-br', 'CorretoresController@listaCorretoresBR');
// lista corretores GILIE BE
Route::get('corretores/lista-corretores-be', 'CorretoresController@listaCorretoresBE');
// lista corretores GILIE BU
Route::get('corretores/lista-corretores-bu', 'CorretoresController@listaCorretoresBU');
// lista corretores GILIE BH
Route::get('corretores/lista-corretores-bh', 'CorretoresController@listaCorretoresBH');
//Cria Planilha
Route::get('corretores/baixar-planilha', 'CorretoresController@criaPlanilhaExcelCorretores');


//ROTA TMA Unificado
//view index
Route::get('contratacao/tempo-medio-atendimento', 'TMA\tmaVisaoUnificadaController@indexVendaAVista');
//Media TMA Financiado
Route::get('tma/media-tma-financiado', 'TMA\tmaVisaoUnificadaController@mediaVendaFinanciada');
//universo venda a vista
Route::get('tma-venda-a-vista', 'TMA\vendaAVistaController@universoVendaAVista');
//Marcar CHB baixado
Route::post('tma/baixar-chb/{chb}', 'TMA\vendaAVistaController@baixarVendaAVista');
//Marcar CHB cancelado
Route::post('tma/cancelar-chb/{chb}', 'TMA\vendaAVistaController@cancelarVendaAVista');
//Marcar CHB aguarda pagamento
Route::post('tma/aguarda-pagamento-chb/{chb}', 'TMA\vendaAVistaController@aguardaVendaAVista');
//universo venda com financiamento
Route::get('tma-venda-com-financimento', 'TMA\vendaFinanciadaController@universoVendaFinanciada');
//Indicadores venda com financiamento
Route::get('tma-indicadores-com-financimento', 'TMA\vendaFinanciadaController@indicadoresTMAfinanciado');
//Indicadores venda à vista
Route::get('tma-indicadores-a-vista', 'TMA\vendaAVistaController@indicadoresTMAaVista');
//Marcar CHB baixado
Route::post('tma/baixar-financiado-chb/{chb}', 'TMA\vendaFinanciadaController@baixarVendaFinanciada');
//Marcar CHB cancelado
Route::post('tma/cancelar-financiado-chb/{chb}', 'TMA\vendaFinanciadaController@cancelarVendaFinanciada');
//Marcar CHB aguarda pagamento
Route::post('tma/aguarda-pagamento-financiado-chb/{chb}', 'TMA\vendaFinanciadaController@aguardaVendaFinanciada');
//Planilha Excel TMA a Vista
Route::get('/tma/baixar-planilha-tma', 'TMA\vendaAVistaController@criaPlanilhaControleTMA');
//Planilha Excel TMA a Vista
Route::get('/tma/baixar-planilha-tma-financiamento', 'TMA\vendaFinanciadaController@criaPlanilhaControleTMAFinanciamento');

//ROTA Controle de Chaves
Route::get('estoque-imoveis/chaves', 'GestaoImoveisCaixa\controleDeChavesController@index');
Route::get('estoque-imoveis/universo-chave', 'GestaoImoveisCaixa\controleDeChavesController@listaUniversoChaves');
Route::get('estoque-imoveis/universo-emprestado', 'GestaoImoveisCaixa\controleDeChavesController@listaChavesEmprestadas');
Route::post('estoque-imoveis/cadastra-chave', 'GestaoImoveisCaixa\controleDeChavesController@adicionarChaves');
Route::post('estoque-imoveis/empresta-chave/{idChave}', 'GestaoImoveisCaixa\controleDeChavesController@emprestaChaves');

//teste de upload
Route::get('/testedeupload', function () {
    return view('portal.upload.testeDeUpload');
});
//Marcar CHB cancelado
Route::post('testedeupload/enviar', 'upload\uploadController@store');

//Controle de Boletos
//view de Boletos
Route::get('/contratacao/controle-boletos', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@index');
//Controle de Boletos lista universo
Route::get('/contratacao/controle-boletos/listar-boleto/{id}', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@listaDadosBoleto');
//Controle de Boletos lista universo a vista
Route::get('/contratacao/controle-boletos/listar-universo-a-vista', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@listaUniversoAvista');
//Controle de Boletos lista universo com financiamento
Route::get('/contratacao/controle-boletos/listar-universo-financiamento', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@listaUniversoFinanciamento');
//Controle de Boletos envia mensageria
Route::get('/contratacao/controle-boletos/envia-mensageria', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@enviaMensageriaGILIES');
//Controle de Boletos lista pagamentos novos
Route::get('/contratacao/controle-boletos/listar-pagamentos-novos', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@listaPagamentosNovos');
//Planilha Excel boletos
Route::get('/contratacao/controle-boletos/baixar-planilha-boletos', 'GestaoImoveisCaixa\ControleDeBoletos\ControleDeBoletos@criaPlanilhaControleBoletos');

//Emissão de O.S
//view de O.S
Route::get('/preparar-e-ofertar/emitir-os', 'OrdemDeServico\ordemDeServicoController@OrdemDeServicoIndex');

//Rotas de Equipe
//View de Equipes
Route::get('/equipe', 'Equipes\equipesController@equipeIndex');
//lista São Paulo
Route::get('/equipe/listar-nomes-equipe', 'Equipes\equipesController@listaNomesEquipes');
Route::get('/equipe/listar-equipe', 'Equipes\equipesController@listaEquipe');
Route::get('/equipe/listar-atividade', 'Equipes\equipesController@listaAtividade');
Route::get('/equipe/listar-gerente-sp', 'Equipes\equipesController@listaGerenteSP');
//lista Porto Alegre
Route::get('/equipe/listar-nomes-equipe-po', 'Equipes\equipesController@listaNomesEquipesPO');
Route::get('/equipe/listar-equipe-po', 'Equipes\equipesController@listaEquipePO');
Route::get('/equipe/listar-atividade-po', 'Equipes\equipesController@listaAtividadePO');
Route::get('/equipe/listar-gerente-po', 'Equipes\equipesController@listaGerentePO');
//lista Belo Horizonte
Route::get('/equipe/listar-nomes-equipe-bh', 'Equipes\equipesController@listaNomesEquipesBH');
Route::get('/equipe/listar-equipe-bh', 'Equipes\equipesController@listaEquipeBH');
Route::get('/equipe/listar-atividade-bh', 'Equipes\equipesController@listaAtividadeBH');
Route::get('/equipe/listar-gerente-bh', 'Equipes\equipesController@listaGerenteBH');
//lista Bauru
Route::get('/equipe/listar-nomes-equipe-bu', 'Equipes\equipesController@listaNomesEquipesBU');
Route::get('/equipe/listar-equipe-bu', 'Equipes\equipesController@listaEquipeBU');
Route::get('/equipe/listar-atividade-bu', 'Equipes\equipesController@listaAtividadeBU');
Route::get('/equipe/listar-gerente-bu', 'Equipes\equipesController@listaGerenteBU');
//lista Belem
Route::get('/equipe/listar-nomes-equipe-be', 'Equipes\equipesController@listaNomesEquipesBE');
Route::get('/equipe/listar-equipe-be', 'Equipes\equipesController@listaEquipeBE');
Route::get('/equipe/listar-atividade-be', 'Equipes\equipesController@listaAtividadeBE');
Route::get('/equipe/listar-gerente-be', 'Equipes\equipesController@listaGerenteBE');
//lista Brasilia
Route::get('/equipe/listar-nomes-equipe-br', 'Equipes\equipesController@listaNomesEquipesBR');
Route::get('/equipe/listar-equipe-br', 'Equipes\equipesController@listaEquipeBR');
Route::get('/equipe/listar-atividade-br', 'Equipes\equipesController@listaAtividadeBR');
Route::get('/equipe/listar-gerente-br', 'Equipes\equipesController@listaGerenteBR');
//lista Curitiba
Route::get('/equipe/listar-nomes-equipe-ct', 'Equipes\equipesController@listaNomesEquipesCT');
Route::get('/equipe/listar-equipe-ct', 'Equipes\equipesController@listaEquipeCT');
Route::get('/equipe/listar-atividade-ct', 'Equipes\equipesController@listaAtividadeCT');
Route::get('/equipe/listar-gerente-ct', 'Equipes\equipesController@listaGerenteCT');
//lista Fortaleza
Route::get('/equipe/listar-nomes-equipe-fo', 'Equipes\equipesController@listaNomesEquipesFO');
Route::get('/equipe/listar-equipe-fo', 'Equipes\equipesController@listaEquipeFO');
Route::get('/equipe/listar-atividade-fo', 'Equipes\equipesController@listaAtividadeFO');
Route::get('/equipe/listar-gerente-fo', 'Equipes\equipesController@listaGerenteFO');
//lista Goiania
Route::get('/equipe/listar-nomes-equipe-go', 'Equipes\equipesController@listaNomesEquipesGO');
Route::get('/equipe/listar-equipe-go', 'Equipes\equipesController@listaEquipeGO');
Route::get('/equipe/listar-atividade-go', 'Equipes\equipesController@listaAtividadeGO');
Route::get('/equipe/listar-gerente-go', 'Equipes\equipesController@listaGerenteGO');
//lista Rio de Janeiro
Route::get('/equipe/listar-nomes-equipe-rj', 'Equipes\equipesController@listaNomesEquipesRJ');
Route::get('/equipe/listar-equipe-rj', 'Equipes\equipesController@listaEquipeRJ');
Route::get('/equipe/listar-atividade-rj', 'Equipes\equipesController@listaAtividadeRJ');
Route::get('/equipe/listar-gerente-rj', 'Equipes\equipesController@listaGerenteRJ');
//lista Recife
Route::get('/equipe/listar-nomes-equipe-re', 'Equipes\equipesController@listaNomesEquipesRE');
Route::get('/equipe/listar-equipe-re', 'Equipes\equipesController@listaEquipeRE');
Route::get('/equipe/listar-atividade-re', 'Equipes\equipesController@listaAtividadeRE');
Route::get('/equipe/listar-gerente-re', 'Equipes\equipesController@listaGerenteRE');
//lista Salvador
Route::get('/equipe/listar-nomes-equipe-sa', 'Equipes\equipesController@listaNomesEquipesSA');
Route::get('/equipe/listar-equipe-sa', 'Equipes\equipesController@listaEquipeSA');
Route::get('/equipe/listar-atividade-sa', 'Equipes\equipesController@listaAtividadeSA');
Route::get('/equipe/listar-gerente-sa', 'Equipes\equipesController@listaGerenteSA');

// ROTAS DE PAGAMENTOS
Route::prefix('pagamentos')->group(function () {
    // RETORNA JSON DE PAGAMENTOS
    Route::get('/{chb}', 'Pagamentos\gestaoDePagamentosController@gestaoDePagamentos');
    // RETORNA JSON DDQ TABELA 1
    Route::get('ddq-1/{chb}', 'Pagamentos\gestaoDDQController@gestaoDDQtabela1');
    // RETORNA JSON DDQ TABELA 2
    Route::get('ddq-2/{chb}', 'Pagamentos\gestaoDDQController@gestaoDDQtabela2');
    // RETORNA JSON DDQ TABELA DADOS
    Route::get('ddq/{chb}', 'Pagamentos\gestaoDDQController@gestaoDDQDados');
        // RETORNA JSON DDQ TABELA CDP
    Route::get('cdp/{chb}', 'Pagamentos\gestaoCDPController@gestaoCDP');

});

// ROTAS DO SIOUV
Route::prefix('gerencial/gestao-siouv')->group(function () {
    // RETORNA VIEW SIOUV
    Route::get('/', 'Siouv\siouvController@indexSiouv');
    // RETORNA UNIVERSO 
    Route::get('/lista-siouv', 'Siouv\siouvController@listaUniversoSiouv');
    // CADASTRA DADOS SIOUV
    Route::post('/cadastra-siouv', 'Siouv\siouvController@cadastraDadosSiouv');
    // MODELO WORD SAC
    Route::get('/modelo-sac/{siouv}', 'Siouv\siouvController@modeloSac');
    // MODELO WORD SIOUV
    Route::get('/modelo-siouv/{siouv}', 'Siouv\siouvController@modeloSIOUV');
    // Responder Siouv
    Route::post('/responder-siouv', 'Siouv\siouvController@responderSiouv');
    // LISTA ATENDES COM STATUS DO DIA
    Route::get('/demandas-siouv', 'Siouv\siouvController@listaSiouvEmAberto');
    // CRIA CE
    Route::get('/cria-ce', 'Siouv\siouvController@criaNumeroCE');
    // VIEW CE
    Route::get('/gestao-siouv-ce', 'Siouv\siouvController@pegaNumeroCE');

});