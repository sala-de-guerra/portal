<?php

if (empty($_FILES['uploadFiles'])) {
    echo json_encode(['error'=>'No files found for upload.']); 
    // or you can throw an exception 
    return; // terminate
};

// get the files posted
$images = $_FILES['uploadFiles'];

// get user id posted
$userid = empty($_POST['matricula']) ? '' : $_POST['matricula'];

// get user name posted
$username = empty($_POST['matricula']) ? '' : $_POST['matricula'];

// get todos os campos

$cpf = $_POST['cpf'];
$cnpj = $_POST['cnpj'];
$nomeCliente = $_POST['nomeCliente'];
$tipoOperacao = $_POST['tipoOperacao'];
$tipoMoeda = $_POST['tipoMoeda'];
$valorOperacao = $_POST['valorOperacao'];
$dataPrevistaEmbarque = $_POST['dataPrevistaEmbarque'];
$responsavelAtual = $_POST['matricula'];

$nomeBeneficiario = $_POST['nomeBeneficiario'];
$nomeBanco = $_POST['nomeBanco'];
$iban = $_POST['iban'];
$AgContaBeneficiario = $_POST['AgContaBeneficiario'];

// a flag to see if everything is ok
$success = null;

// file paths to store
$paths= [];

// get file names
$filenames = $images['name'];
// loop and process files
for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames[$i]));
    $target = "../../js/contratacao/upload-teste/" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);

    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
        $success = true;
        $paths[] = $target;
    } else {
        $success = false;
        break;
    }
}

// check and process based on successful status 
if ($success === true) {
    // call the function to save all data to database
    // code for the following function `save_data` is not 
    // mentioned in this example
    save_data($userid, $username, $paths);

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = [$cpf,$cnpj,$nomeCliente,$tipoOperacao,$tipoMoeda,$valorOperacao,$dataPrevistaEmbarque,$dataPrevistaEmbarque,$responsavelAtual,$nomeBeneficiario,$nomeBanco,$iban,$AgContaBeneficiario,$filenames];
    // for example you can get the list of files uploaded this way
    $output = ['uploaded' => $paths];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
    // delete any uploaded files
    foreach ($paths as $file) {
        unlink($file);
    }
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
// print_r(json_encode($output));
return json_encode($output);
// $arrayDados = [];

// array_push($arrayDados, $_POST);

// print_r($arrayDados); 

?>