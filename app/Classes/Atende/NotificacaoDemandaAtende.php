
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
    <title>Notificação de demanda ATENDE - %NU_ATENDE%</title>

</head>


<body style='font-family: sans-serif; padding: 20px'>


<p class="nao-responder">MENSAGEM AUTOMÁTICA. FAVOR NÃO RESPONDER.</p><br><br>

<p>À</p>

<p>%NOME%</p>

<br><br>
    <p>Prezado (a),</p>

    <p>Notificamos o direcionamento do ATENDE nº: <b>%NU_ATENDE%</b> para as suas demandas em <a href="https://portal.gilie.sp.caixa/atende/minhas-demandas"> https://portal.gilie.sp.caixa/atende/minhas-demandas</a> </p> 
    <p>a finalização da demanda deverá ser em %quantidade_dias% dias.</p>

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