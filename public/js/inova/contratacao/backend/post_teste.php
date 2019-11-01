<?php
// if(isset($_POST['submit'])){
//     // File upload configuration
//     $targetDir = "www.ceopc.hom.sp.caixa\\esteira-contratacao\uploads";
//     $allowTypes = array('jpg','png','jpeg','pdf');
    
//     $images_arr = array();
//     foreach($_FILES['uploadFiles']['name'] as $key=>$val){
//         $image_name = $_FILES['invoice_']['name'][$key];
//         $tmp_name   = $_FILES['invoice_']['tmp_name'][$key];
        
//         // File upload path
//         $fileName = basename($_FILES['uploadFiles']['name'][$key]);
//         $targetFilePath = $targetDir . $fileName;
        
//         // Check whether file type is valid
//         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
//         if(in_array($fileType, $allowTypes)){    
//             // Store images on the server
//             if(move_uploaded_file($_FILES['uploadFiles']['tmp_name'][$key],$targetFilePath)){
//                 $images_arr[] = $targetFilePath;
//             }
//         }
//     }
    
// }
			
print_r($_POST);
print_r($_FILES);


			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			// $arrayDados = [];

			// array_push($arrayDados, $_POST);
			// var_dump($_POST);

			// $numUploadedfiles = count($_FILES);
			// for($i = 0; $i < $numUploadedfiles; $i++)
			// {
			// 	echo "<br>filename " . $i . " is: " . $_FILES[$i];
			// }


		// print_r($arrayDados); 





		


			// array_push($arrayDados, \$_FILES['invoiceImpAnt']);

			
			// print_r($arrayDados); 

			// $mensagem = json_encode($_POST);			
			// // $mensagem2 = json_encode($_FILES);

			// $sucesso = "mensagem: Cadastrado realizado com sucesso.";



			// print_r($mensagem);
			// echo $sucesso;


			// if (isset($_FILES['invoice_'])) {

			// 	$arquivo = array();
			//   foreach ($_FILES['invoice_']["name"] as $file=>$key) {
		  
			// 				  // the empty input files create an array index too, so we need to
			// 				  // check if the name exits. It means the file exists.
			// 	  if (!empty($_FILES['invoice_']["name"][$file]))
			// 	   {
			// 		$arquivo ["name"] = $_FILES['invoice_']["name"][$file];
			// 		// $arquivo ["type"] = $_FILES['foto']["type"][$file];
			// 		// $arquivo ["tmp_name"] = $_FILES['foto']["tmp_name"][$file];
			// 		// $arquivo ["error"] = $_FILES['foto']["error"][$file];
			// 		// $arquivo ["size"] = $_FILES['foto']["size"][$file];
			// 		$mensagem = json_encode($arquivo);
			// 		$sucesso = "mensagem: Cadastrado realizado com sucesso.";

			// 		print_r($mensagem);
			// 		echo $sucesso;

			// 	  }


			// 	}
			// }

			?>