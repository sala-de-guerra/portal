
<!DOCTYPE html>
<html lang="pt-br">
    <style>
    .fixarRodape {
        bottom: 0;
        position: fixed;
        width: 90%;
    }
    
    .nao-responder{
        color:gray;
        font-weight: bolder;
    }
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="./estilos.css">  não deu --> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificação de demanda ATENDE</title>

</head>


<body style='font-family: sans-serif; padding: 20px'>


<p class="nao-responder">MENSAGEM AUTOMÁTICA. FAVOR NÃO RESPONDER.</p><br><br>
<br><br>
    <p>Prezado (a),<br>
    Notificamos o direcionamento de ATENDE para as suas demandas</p>

    <b>Assunto: </b> %Assunto% <br><br>
    esta demanda está disponível para tratamento em <a href="https://portal.gilie.sp.caixa/atende/minhas-demandas"> https://portal.gilie.sp.caixa/atende/minhas-demandas</a> </p> 
    <p>a resposta deverá ser efetuada até <b> %quantidade_dias%  </b>.</p><br><br>

<footer class="fixarRodape">    
<p class="destaque">
Atenciosamente,
<br><br>
GILIE/SP | GI ALIENAR BENS MOVEIS E IMOVEIS<br>
<a href="https://portal.gilie.sp.caixa/">https://portal.gilie.sp.caixa/</a>;  
</p>
</footer>


</body>
</html>