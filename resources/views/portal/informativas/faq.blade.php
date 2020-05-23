@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Dúvidas Frequentes
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Dúvidas Frequentes </li>
        </ol>
    </div>
</div>


@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Esclarecemos que os imóveis podem ser retirados da venda a qualquer momento. <br>
                    Consulte a relação atualizada no site da CAIXA, 
                    <a href="http://www.caixa.gov.br/voce/habitacao/imoveis-venda">http://www.caixa.gov.br/voce/habitacao/imoveis-venda</a>.
                </h3>
            </div> <!-- /.card-header -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

</div> <!-- /.row -->
    
<div class="row">

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                    Quem pode adquirir imóveis da Caixa?
                    <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Podem adquirir imóveis da Caixa qualquer pessoa, física ou jurídica, com exceção dos interessados 
                        que tenham relação de parentesco, até terceiro grau civil, com dirigente da CAIXA, empregado da 
                        CAIXA que atue na SUINP e autoridade do ente público a que a CAIXA esteja vinculada. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                    Que tipos de imóveis da Caixa estão à venda?
                    <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Estão à venda casas, apartamentos e outros tipos de diversos valores. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        A Caixa possibilita a aquisição financiada do(s) imóvel(is) e utilização do FGTS?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Sim, no caso de financiamento, o prazo, as modalidades, as condições do interessado e os valores deverão enquadrar-se nas 
                        exigências da CAIXA. Para a utilização de FGTS com a finalidade de aquisição de imóvel, deverão ser observadas as condições 
                        vigentes do Conselho Curador do FGTS, inteire-se das condições necessárias junto a uma agência da CAIXA.  
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        Como adquirir o imóvel?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Os imóveis da Caixa à venda podem ser adquiridos por meio de Concorrência Pública, Venda Direta e Leilão.  
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->
        
    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        Como se dá a compra de um imóvel na modalidade concorrência pública/licitação fechada?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        O imóvel é vendido para o interessado que fizer a melhor oferta, respeitado o preço mínimo de venda do imóvel. 
                        Para isso basta apresentar uma proposta de compra, em envelope lacrado para posterior abertura e classificação. 
                        Os critérios de avaliação são pré-estabelecidos pela Caixa e são de conhecimento público.   
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        Como se dá a compra de um imóvel na modalidade leilão/licitação aberta?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Nos leilões, as ofertas para a aquisição do imóvel são feitas verbalmente, respeitando o valor mínimo de venda do imóvel. 
                        Será considerado lance vencedor aquele que resultar no maior valor acima do preço mínimo apresentado no ato do leilão.
                        Nesta modalidade de venda há pagamento no ato do leilão da comissão do leiloeiro que corresponde a 5% do lance vencedor e 
                        5 % de sinal para garantia de contratação, calculados sob o valor do lance ofertado. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        O que é depósito de Caução?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        O depósito caução é uma garantia que habilita a proposta apresentada pelo interessado nas modalidades concorrência pública 
                        e venda direta. Ele corresponde a 5% do valor de avaliação do imóvel que você deseja adquirir e deve ser recolhida em uma 
                        conta de Caução, aberta no nome do interessado, em uma Agência da Caixa. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->
    
    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        Quais as vantagens oferecidas pela CAIXA a quem deseja adquirir um dos imóveis da Caixa à venda?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Ao adquirir um imóvel CAIXA você tem garantidos a legalidade da documentação do imóvel; a possibilidade de aquisição 
                        com financiamento e ainda a certeza de que contas e impostos em atraso serão pagos pela CAIXA (desde que o comprador 
                        não seja o responsável pelos débitos existentes, venda ao Ocupante), salvo em licitações especiais, com pendências, 
                        lançadas esporadicamente pela CAIXA. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->
    
    
    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        A CAIXA possibilita a aquisição utilizando Consórcio?
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Não, pois os prazos para liberação dos valores pelos Consórcios excedem os prazos de pagamento definidos no edital. 
                        Além disso, os consórcios têm os imóveis como garantia, o que não é possível nos casos dos imóveis adjudicados CAIXA/EMGEA. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        A CAIXA possibilita a aquisição utilizando Financiamento por outra Instituição Financeira? 
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Não, uma vez que para concessão de financiamento em outras instituições, a CAIXA/EMGEA figurariam como vendedoras, 
                        tendo que disponibilizar toda documentação da empresa a outro banco, o que não seria possível. Ademais, os prazos para 
                        concessão do financiamento por outras instituições ultrapassam os limites de tempo definidos em edital.  
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->
    
    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        Se eu comprar um imóvel ocupado, quem será responsável por retirar o ocupante? 
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Os imóveis CAIXA são vendidos no estado físico e de ocupação em que se encontram. Sendo assim, após a aquisição, 
                        o comprador deverá negociar a saída do ocupante, ou efetuar o acionamento judicial para tomada da posse do imóvel. 
                        Consulte um advogado: A lei está do seu lado: "O artigo 30 da Lei 9.514/97 diz o seguinte: Art. 30. É assegurada ao 
                        fiduciário, seu cessionário ou sucessores, inclusive o adquirente do imóvel por força do público leilão de que tratam 
                        os parágrafos 1 e 2 do art. 27, a reintegração na posse do imóvel, que será concedida liminarmente, para desocupação 
                        em sessenta dias, desde que comprovada, na forma do disposto no art. 26, a consolidação da propriedade em seu nome." 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->
    
    <div class="col-md-12">
        <div class="card collapsed-card direct-chat direct-chat-primary">

            <div class="card-header">
                <img class="direct-chat-img" src="../img/question-mark.png" alt="Message User Image">
                <div class="direct-chat-text cursor-pointer" data-card-widget="collapse">
                        Se eu desistir da aquisição do imóvel, o que acontece?  
                        <div class="float-sm-right">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                    </div>
                </div> <!-- /.direct-chat-text -->
            </div> <!-- /.card-header -->

            <div class="card-body padding1220">
                <div class="direct-chat-msg right">
                    <img class="direct-chat-img" src="../img/logo-caixa-app.png" style="background-color: #247cb4;" alt="Message User Image">
                    <div class="direct-chat-text ">
                        Caso a desistência seja realizada pelo comprador sem justa causa, o valor pago a CAIXA a titulo de caução; (nos casos de 
                        Licitação Fechada ou Venda Direta), ou, sinal e comissão do leiloeiro, (nos casos de Leilões Públicos ou Licitação Aberta), 
                        serão apropriados pela CAIXA a título de multa; Caso haja justa causa, tais como; decisão judicial posterior, informações 
                        comprovadamente divergentes constantes do edital, entre outras, após constatação e deferimento da CAIXA, será realizado 
                        o distrato da operação, com a devolução dos valores pagos pelo arrematante, tais como: Valores utilizados para pagamento 
                        do imóvel; inclusive parcelas pagas de financiamento, despesas cartorárias e tarifas. 
                    </div> <!-- /.direct-chat-text -->
                </div> <!-- /.direct-chat-msg -->
            </div> <!-- /.card-body -->

        </div> <!-- /.card -->
    </div> <!-- /.col -->
    
</div> <!-- /.row -->

@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
@stop


@section('js')

@stop