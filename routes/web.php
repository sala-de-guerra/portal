<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

//index
Route::get('/', function () {
    return view('portal.index');
});    

//teste
Route::get('/teste', function () {
    return view('teste');
});    


 // sobre
 Route::get('/sobre', function () {
    return view('portal.informativas.sobre');
});

 // duvidas frequentes
 Route::get('/faq', function () {
    return view('portal.informativas.faq');
});

 // orientações
 Route::get('/orientacoes', function () {
    return view('portal.informativas.orientacoes');
});

 // conheca o projeto
 Route::get('/projeto', function () {
    return view('portal.informativas.projeto');
});


// Controle de Contratação
Route::get('/controle-contratacao', function () {
    return view('portal.imoveis.controle-contratacao');
});

// Pesquisar

Route::get('/pesquisar', function () {
    return view('portal.imoveis.pesquisar');
});


// Consulta de bem imóvel

Route::get('/consulta-bem-imovel/{contrato}', 'GestaoImoveisCaixa\ContratosEstoqueCaixa@show');

// Rotina Automatica de envio de mensagens Adjudicados

Route::prefix('estoque-imoveis')->group(function () {
    Route::get('rotina-mensagens', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasAutorizacaoContratacao');
    Route::get('rotina-mensagens-com-contrato-fixo', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@enviarMensageriasComRelacaoFixaDeContratos');
    Route::get('rota-charles-imoveis-caixa', 'GestaoImoveisCaixa\RotinaMensagensAutomatica@mensagemAutorizacaoCaixaEngeaCharles');
    Route::get('consulta-contrato/{contrato}', 'GestaoImoveisCaixa\ContratosEstoqueCaixa@capturaDadosBaseSimov');
    Route::get('teste-ldap/{matricula}/{usuario}/{senha}', function($matricula, $usuario, $senha) {
        
        $server = "ldaps://corp.caixa.gov.br"; //Servidor LDAPS/AD corpcaixa-conexão SSL
        $user = "corpcaixa\\$usuario"; //usuário de serviço ou usuário que está autenticando no ldap
        $psw = $senha; //senha do usuário de serviço ou do usuário que está autenticando no ldap
        $dn = "OU=Usuarios,OU=CAIXA,DC=corp,DC=caixa,DC=gov,DC=br"; //código para consulta dos usuários na caixa
        
        // dd("$user");
        
        $search = "(sAMAccountName=$matricula)";  //usuário o qual se procura a foto
        // ------------------------------------------------------------------------
        
        echo "<h2>php LDAP query test</h2>";
        // connecting to LDAP server
        $ds = ldap_connect($server);
        $r = ldap_bind($ds, $user , $psw);
        // performing search
        $sr = ldap_search($ds, $dn, $search);
        $data = ldap_get_entries($ds, $sr);
        
        echo "Found " . $data["count"] . " entries";
        
        for ($i = 0; $i < $data["count"]; $i++) {
            echo "<h4><strong>Common Name: </strong>" . $data[$i]["cn"][0] . "</h4><br />";
            echo "<strong>Distinguished Name: </strong>" . $data[$i]["dn"] . "<br />";
        
            // Check if user photo exists
            if (isset($data[$i]["thumbnailphoto"]) && isset($data[$i]["thumbnailphoto"][0])) {
                echo "<strong>Photo in Base64: </strong>" . base64_encode($data[$i]["thumbnailphoto"][0]) . "<br />";
               echo '<img src="data:image/jpeg;base64,'. base64_encode($data[$i]["thumbnailphoto"][0]) .'" /><br />';
            }
            else {
                echo "<strong>Photo not set</strong><br />";
            }
        
            // Checking if discription exists 
            if (isset($data[$i]["description"][0])) {
                echo "<strong>Desription: </strong>" . $data[$i]["description"][0] . "<br />";
            }
            else {
                echo "<strong>Description not set</strong><br />";
            }
        
            // Checking if email exists
            if (isset($data[$i]["mail"][0])){
                echo "<strong>Email: </strong>" . $data[$i]["mail"][0] . "<br /><hr />";
            }
            else {
                echo "<strong>Email not set</strong><br /><hr />";
            }
        }
        
        // close connection
        ldap_close($ds);
    });
});

// Rotina Automatica de envio de mensagens Adjudicados

Route::prefix('portal')->group(function () {
    Route::get('cria-json-google', 'JsonGooglePortal@criaJsonParaAbastecerBarraPesquisaGoogle');
});

// Gerencial

// equipes
Route::get('/equipes', function () {
    return view('portal.gerencial.equipes');
});

