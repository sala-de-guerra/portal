@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Resultado Pesquisa Conhecimento CEPAT
        </h1>
    </div>
    
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Indicadores</li>
            <li class="breadcrumb-item active"> Pesquisa CEPAT</li>
        </ol>
    </div>
    
</div>


@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-body">
                
                <div class="d-flex justify-content-between">
                    <strong>Quantidade respostas: <span style="color: #295dd2">85</span> 
                    &nbsp&nbsp&nbsp&nbsp&nbsp
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#ModalLongoExemplo">
                        Usuários que responderam a pesquisa
                    </button>
                </div>
                
<!-- Modal -->
<div class="modal fade" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalLongoExemplo">Usuários que responderam a pesquisa:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table class="table table-bordered table-striped">
                    <thead>                   
                        <tr>
                            <th>Usuário</th>
                            <th>Matrícula</th>
                        </tr>
                    </thead>
                    <tbody class="font-weight-normal">
                    <tr>	<td>	Rafael Goncalves	</td>	<td>	c098453	</td>	</tr>
<tr>	<td>	Benedita Silveira	</td>	<td>	c039978	</td>	</tr>
<tr>	<td>	Camila Coutinho	</td>	<td>	c090719	</td>	</tr>
<tr>	<td>	Katia Rodrigues	</td>	<td>	c130343	</td>	</tr>
<tr>	<td>	Daniel Almeida	</td>	<td>	c122898	</td>	</tr>
<tr>	<td>	Isaac Benzecry	</td>	<td>	c080853	</td>	</tr>
<tr>	<td>	Renata Melo	</td>	<td>	c066517	</td>	</tr>
<tr>	<td>	Elisabete Almeida	</td>	<td>	c035647	</td>	</tr>
<tr>	<td>	Elenisa Ribeiro	</td>	<td>	c051699	</td>	</tr>
<tr>	<td>	Rodrigo Oliveira	</td>	<td>	c086588	</td>	</tr>
<tr>	<td>	Osmar Junior	</td>	<td>	c050495	</td>	</tr>
<tr>	<td>	Roselene Lins	</td>	<td>	c069106	</td>	</tr>
<tr>	<td>	Flaviane Novaes	</td>	<td>	c085308	</td>	</tr>
<tr>	<td>	Melissa Silva	</td>	<td>	c061913	</td>	</tr>
<tr>	<td>	Fernanda Okubo	</td>	<td>	c142639	</td>	</tr>
<tr>	<td>	Marcelo Moraes	</td>	<td>	c023937	</td>	</tr>
<tr>	<td>	Selmer Grillo	</td>	<td>	c099532	</td>	</tr>
<tr>	<td>	Adriana Martins	</td>	<td>	c078433	</td>	</tr>
<tr>	<td>	Solange Pedro	</td>	<td>	c0616497	</td>	</tr>
<tr>	<td>	Ary Silva	</td>	<td>	c038332	</td>	</tr>
<tr>	<td>	Jose Oliveira	</td>	<td>	c081629	</td>	</tr>
<tr>	<td>	Carlos Arruda	</td>	<td>	c093677	</td>	</tr>
<tr>	<td>	Nathaly Shibata	</td>	<td>	c113384	</td>	</tr>
<tr>	<td>	Sandra Dores	</td>	<td>	c059653	</td>	</tr>
<tr>	<td>	Fernando Barros	</td>	<td>	c040574	</td>	</tr>
<tr>	<td>	Carla Pereira	</td>	<td>	c082403	</td>	</tr>
<tr>	<td>	Wellington Castro	</td>	<td>	c886114	</td>	</tr>
<tr>	<td>	Emanuel Silva	</td>	<td>	c066664	</td>	</tr>
<tr>	<td>	Diego Macedo	</td>	<td>	1347527	</td>	</tr>
<tr>	<td>	Anderson Jesus	</td>	<td>	c064598	</td>	</tr>
<tr>	<td>	Luciane Kuhnen	</td>	<td>	c038311	</td>	</tr>
<tr>	<td>	Mariele Giglioli	</td>	<td>	c139819	</td>	</tr>
<tr>	<td>	Joao Junior	</td>	<td>	c086928	</td>	</tr>
<tr>	<td>	Rosana Oliveira	</td>	<td>	c073384	</td>	</tr>
<tr>	<td>	Edvandro Segantini	</td>	<td>	c052539	</td>	</tr>
<tr>	<td>	Ana Barreiros	</td>	<td>	c074575-7	</td>	</tr>
<tr>	<td>	Rafaela Lopes	</td>	<td>	C116059	</td>	</tr>
<tr>	<td>	Celso Watanabe	</td>	<td>	C050505	</td>	</tr>
<tr>	<td>	Luiz Nascimento	</td>	<td>	c095043	</td>	</tr>
<tr>	<td>	Aurino Junior	</td>	<td>	c040769	</td>	</tr>
<tr>	<td>	Fernando Amorim	</td>	<td>	c115032	</td>	</tr>
<tr>	<td>	Ana Monteiro	</td>	<td>	c137977	</td>	</tr>
<tr>	<td>	Sergio Bonet	</td>	<td>	c029349	</td>	</tr>
<tr>	<td>	Marisa Guerreiro	</td>	<td>	C090681	</td>	</tr>
<tr>	<td>	Selir Freitas	</td>	<td>	c044731	</td>	</tr>
<tr>	<td>	Sylvia Pezzuto	</td>	<td>	c052124	</td>	</tr>
<tr>	<td>	Milena Lessa	</td>	<td>	c118399	</td>	</tr>
<tr>	<td>	Erlon Orlandi	</td>	<td>	c104641	</td>	</tr>
<tr>	<td>	Diego Lopes	</td>	<td>	c067323	</td>	</tr>
<tr>	<td>	Thais Almeida	</td>	<td>	c068260	</td>	</tr>
<tr>	<td>	Marcelo Silveira	</td>	<td>	c082344	</td>	</tr>
<tr>	<td>	Karina Macacari	</td>	<td>	C128877	</td>	</tr>
<tr>	<td>	Cristiano Carvalho	</td>	<td>	c139305	</td>	</tr>
<tr>	<td>	Fausto Filho	</td>	<td>	c086927	</td>	</tr>
<tr>	<td>	Caroline Rodrigues	</td>	<td>	c111409	</td>	</tr>
<tr>	<td>	Patricia Pereira	</td>	<td>	C109636	</td>	</tr>
<tr>	<td>	Debora Pereira	</td>	<td>	c109188	</td>	</tr>
<tr>	<td>	Danielli Crivelaro	</td>	<td>	c058481	</td>	</tr>
<tr>	<td>	Joao Filho	</td>	<td>	c081305	</td>	</tr>
<tr>	<td>	Ana Costa	</td>	<td>	c090153	</td>	</tr>
<tr>	<td>	Vanessa Janini	</td>	<td>	c076585	</td>	</tr>
<tr>	<td>	Claudio Gaiotti	</td>	<td>	C052256	</td>	</tr>
<tr>	<td>	Vanessa Candioto	</td>	<td>	c074072	</td>	</tr>
<tr>	<td>	Edmar Rezende	</td>	<td>	c040862	</td>	</tr>
<tr>	<td>	Luiz Negri	</td>	<td>	c091065	</td>	</tr>
<tr>	<td>	Tereza Przebeiovicz	</td>	<td>	c066539	</td>	</tr>
<tr>	<td>	Ana Almeida	</td>	<td>	c092895	</td>	</tr>
<tr>	<td>	Isabelle Silva	</td>	<td>	c085527	</td>	</tr>
<tr>	<td>	Fernanda Mendonca	</td>	<td>	c072452	</td>	</tr>
<tr>	<td>	Fernanda Mota	</td>	<td>	c053377	</td>	</tr>
<tr>	<td>	Silvio Butiglieri	</td>	<td>	c084062	</td>	</tr>
<tr>	<td>	Jose Rocha	</td>	<td>	c082333	</td>	</tr>
<tr>	<td>	Sergio Sousa	</td>	<td>	c854570	</td>	</tr>
<tr>	<td>	Diego Macedo	</td>	<td>	c1347527	</td>	</tr>
<tr>	<td>	Rosilene Silva	</td>	<td>	c136667	</td>	</tr>
<tr>	<td>	Luiz Nascimento	</td>	<td>	c095043	</td>	</tr>
<tr>	<td>	Flavia Siqueira	</td>	<td>	c139620	</td>	</tr>
<tr>	<td>	Joao Quintiliano	</td>	<td>	c066241	</td>	</tr>
<tr>	<td>	Ari Bordoni	</td>	<td>	c078441	</td>	</tr>
<tr>	<td>	Maristela Pires	</td>	<td>	c038350	</td>	</tr>
<tr>	<td>	Marcelo Padovese	</td>	<td>	c052462	</td>	</tr>
<tr>	<td>	Alexandre Silva	</td>	<td>	c070113	</td>	</tr>
<tr>	<td>	Antonio Cruz	</td>	<td>	c040644	</td>	</tr>
<tr>	<td>	Elias Junior	</td>	<td>	c048298	</td>	</tr>

</tbody> 
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



                
                <br>
                <section class="content">
                <div class="container-fluid">
            
                    <div class="row">
                        <div class="container">
                            <div class="row">
                            <div class="col">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <p class="text-center">PAR Danos Físicos e Regularização Documental</p>
                                    </div>
                                
                                    <a data-toggle="collapse" aria-expanded="false" aria-controls="listaNovos" href="#listaParDanos" class="small-box-footer text-muted font-weight-light" role="button" id="listagemParDanos"onclick="mudaInfoParDanos()">Mais informações</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <p class="text-center">PAR Administração e Pagamentos</p>
                                    </div>
                                    <a data-toggle="collapse" aria-expanded="false" aria-controls="listaParAdm" href="#listaParAdm" class="small-box-footer text-muted font-weight-light" role="button" id="listagemParAdm" onclick="mudaInfoParAdm()">Mais informações</a>
                                </div>
                            </div>
                
                            <div class="col">
                                <div class="small-box bg-maroon">
                                    <div class="inner">
                                        <p class="text-center">PAR Alienação<br>&nbsp</p>
                                    </div>
                                    <a data-toggle="collapse" aria-expanded="false" aria-controls="listaParAlienar" href="#listaParAlienar" class="small-box-footer text-muted font-weight-light" role="button" id="listagemParAlienar" onclick="mudaInfoParAlienar()">Mais informações</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="small-box bg-purple">
                                    <div class="inner">
                                        <p class="text-center">Bens Móveis<br>&nbsp</p>
                                    </div>
                                    <a data-toggle="collapse" aria-expanded="false" aria-controls="listaBensMoveis" href="#listaBensMoveis" class="small-box-footer text-muted font-weight-light" role="button" id="listagemBensMoveis" onclick="mudaInfoBensMoveis()">Mais informações</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="small-box bg-navy">
                                    <div class="inner" style="color:white;">
                                        <p class="text-center">Inovação / Atendimento / Compliance / RH</p>
                                    </div>
                                    <a data-toggle="collapse" aria-expanded="false" aria-controls="listaInovacao" href="#listaInovacao" class="small-box-footer text-muted font-weight-light" role="button" id="listagemInovacao" onclick="mudaInfoInovacao()">Mais informações</a>
                                </div>
                            </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="collapse" id="listaParDanos">
                    <div class="card card-body card-outline card-info">
                        <h2 class="card-title"><b>PAR Danos Físicos e Regularização Documental</b></h2>&nbsp
                        <div class="container">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header"style="color:#3c8dbc">
                                    5 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Osmar Junior</li>
                                    <li>Solange Pedro</li>
                                    <li>Fernando Amorim</li>
                                    <li>Debora Pereira</li>
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#3c8dbc">
                                4 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Ary Silva</li>
                                    <li>Carla Pereira</li>
                                    <li>Marcelo Silveira</li>
                                    <li>Claudio Gaiotti</li>
                                    <li>Fernanda Mota</li>
                                    <li>Antonio Cruz
                                    <li>Elias Junior
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header"style="color:#3c8dbc">
                                    3 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Katia Rodrigues</li>
                                    <li>Flaviane Novaes</li>
                                    <li>Wellington Castro</li>
                                    <li>Diego Macedo</li>
                                    <li>Celso Watanabe</li>
                                    <li>Aurino Junior</li>
                                    <li>Sylvia Pezzuto</li>
                                    <li>Ana Costa</li>
                                    <li>Fernanda Mendonca</li>
                                    <li>Jose Rocha</li>
                                    <li>Diego Macedo</li>
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header"style="color:#3c8dbc">
                                    2 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i><i class="far fa-star" ></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Benedita Silveira</li>
                                    <li>Isaac Benzecry</li>
                                    <li>Melissa Silva</li>
                                    <li>Marcelo Moraes</li>
                                    <li>Adriana Martins</li>
                                    <li>Jose Oliveira</li>
                                    <li>Fernando Barros</li>
                                    <li>Marisa Guerreiro</li>
                                    <li>Selir Freitas</li>
                                    <li>Milena Lessa</li>
                                    <li>Karina Macacari</li>
                                    <li>Sergio Sousa</li>
                                    <li>Luiz Nascimento</li>
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#3c8dbc">
                                    1 estrela<i class="fas fa-star"></i><i class="far fa-star" ></i><i class="far fa-star" ></i><i class="far fa-star" ></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Rafael Goncalves</li>
                                    <li>Camila Coutinho</li>
                                    <li>Daniel Almeida</li>
                                    <li>Renata Melo</li>
                                    <li>Elisabete Almeida</li>
                                    <li>Elenisa Ribeiro</li>
                                    <li>Rodrigo Oliveira
                                    <li>Roselene Lins
                                    <li>Fernanda Okubo
                                    <li>Selmer Grillo
                                    <li>Carlos Arruda
                                    <li>Nathaly Shibata
                                    <li>Sandra Dores
                                    <li>Emanuel Silva
                                    <li>Anderson Jesus
                                    <li>Luciane Kuhnen
                                    <li>Mariele Giglioli
                                    <li>Joao Junior
                                    <li>Rosana Oliveira
                                    <li>Edvandro Segantini
                                    <li>Ana Barreiros
                                    <li>Rafaela Lopes
                                    <li>Luiz Nascimento
                                    <li>Ana Monteiro
                                    <li>Sergio Bonet
                                    <li>Erlon Orlandi
                                    <li>Diego Lopes
                                    <li>Thais Almeida
                                    <li>Cristiano Carvalho
                                    <li>Fausto Filho
                                    <li>Caroline Rodrigues
                                    <li>Patricia Pereira
                                    <li>Danielli Crivelaro
                                    <li>Joao Filho
                                    <li>Vanessa Janini
                                    <li>Vanessa Candioto
                                    <li>Edmar Rezende
                                    <li>Luiz Negri
                                    <li>Luiz Negri
                                    <li>Tereza Przebeiovicz
                                    <li>Ana Almeida
                                    <li>Isabelle Silva
                                    <li>Silvio Butiglieri
                                    <li>Rosilene Silva
                                    <li>Flavia Siqueira
                                    <li>Joao Quintiliano
                                    <li>Ari Bordoni
                                    <li>Maristela Pires
                                    <li>Marcelo Padovese
                                    <li>Alexandre Silva	

                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="collapse" id="listaParAdm">
                    <div class="card card-body card-outline card-success">
                        <h2 class="card-title"><b>PAR Administração e Pagamentos</b></h2>&nbsp
                        <div class="container">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#00a65a">
                                    5 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Daniel Almeida
                                    <li>Elisabete Almeida
                                    <li>Osmar Junior
                                    <li>Marcelo Moraes
                                    <li>Selmer Grillo
                                    <li>Ary Silva
                                    <li>Jose Oliveira
                                    <li>Marisa Guerreiro
                                    <li>Sylvia Pezzuto
                                    <li>Milena Lessa
                                    <li>Erlon Orlandi
                                    <li>Diego Lopes
                                    <li>Fausto Filho
                                    <li>Caroline Rodrigues
                                    <li>Patricia Pereira
                                    <li>Debora Pereira
                                    <li>Danielli Crivelaro
                                    <li>Joao Filho
                                    <li>Claudio Gaiotti
                                    <li>Vanessa Candioto
                                    <li>Edmar Rezende
                                    <li>Luiz Negri
                                    <li>Fernanda Mota
                                    <li>Silvio Butiglieri
                                    <li>Jose Rocha
                                    <li>Elias Junior	
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#00a65a">
                                4 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Katia Rodrigues
                                    <li>Adriana Martins
                                    <li>Solange Pedro
                                    <li>Fernando Barros
                                    <li>Celso Watanabe
                                    <li>Fernando Amorim
                                    <li>Ana Monteiro
                                    <li>Sergio Bonet
                                    <li>Marcelo Silveira
                                    <li>Karina Macacari
                                    <li>Ana Costa
                                    <li>Sergio Sousa
                                    <li>Flavia Siqueira
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#00a65a">
                                    3 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Isaac Benzecry
                                    <li>Roselene Lins
                                    <li>Ana Barreiros
                                    <li>Luiz Nascimento
                                    <li>Aurino Junior
                                    <li>Ana Almeida
                                    <li>Fernanda Mendonca
                                    <li>Rosilene Silva
                                    <li>Luiz Nascimento

                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#00a65a">
                                    2 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Benedita Silveira
                                    <li>Camila Coutinho
                                    <li>Fernanda Okubo
                                    <li>Carla Pereira
                                    <li>Luciane Kuhnen
                                    <li>Rafaela Lopes
                                    <li>Selir Freitas
                                    <li>Diego Macedo
                                    <li>Maristela Pires
                                    <li>Alexandre Silva	

                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#00a65a">
                                    1 estrela<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Rafael Goncalves
                                    <li>Renata Melo
                                    <li>Elenisa Ribeiro
                                    <li>Rodrigo Oliveira
                                    <li>Flaviane Novaes
                                    <li>Melissa Silva
                                    <li>Carlos Arruda
                                    <li>Nathaly Shibata
                                    <li>Sandra Dores
                                    <li>Wellington Castro
                                    <li>Emanuel Silva
                                    <li>Diego Macedo
                                    <li>Anderson Jesus
                                    <li>Mariele Giglioli
                                    <li>Joao Junior
                                    <li>Rosana Oliveira
                                    <li>Edvandro Segantini
                                    <li>Thais Almeida
                                    <li>Cristiano Carvalho
                                    <li>Vanessa Janini
                                    <li>Tereza Przebeiovicz
                                    <li>Isabelle Silva
                                    <li>Joao Quintiliano
                                    <li>Ari Bordoni
                                    <li>Marcelo Padovese
                                    <li>Antonio Cruz
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="collapse" id="listaParAlienar">
                    <div class="card card-body card-outline card-maroon">
                        <h2 class="card-title"><b>PAR Alienação</b></h2>&nbsp
                        <div class="container">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#D81B60">
                                    5 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Daniel Almeida
                                    <li>Osmar Junior
                                    <li>Roselene Lins
                                    <li>Jose Oliveira
                                    <li>Carlos Arruda
                                    <li>Nathaly Shibata
                                    <li>Sandra Dores
                                    <li>Wellington Castro
                                    <li>Emanuel Silva
                                    <li>Mariele Giglioli
                                    <li>Joao Junior
                                    <li>Rosana Oliveira
                                    <li>Edvandro Segantini
                                    <li>Rafaela Lopes
                                    <li>Aurino Junior
                                    <li>Sergio Bonet
                                    <li>Sylvia Pezzuto
                                    <li>Diego Lopes
                                    <li>Thais Almeida
                                    <li>Karina Macacari
                                    <li>Cristiano Carvalho
                                    <li>Fausto Filho
                                    <li>Ana Costa
                                    <li>Vanessa Candioto
                                    <li>Tereza Przebeiovicz
                                    <li>Isabelle Silva
                                    <li>Fernanda Mendonca
                                    <li>Marcelo Padovese
                                    <li>Alexandre Silva
                                    <li>Elias Junior

                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#D81B60">
                                4 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Camila Coutinho
                                    <li>Elenisa Ribeiro
                                    <li>Melissa Silva
                                    <li>Fernando Barros
                                    <li>Marisa Guerreiro
                                    <li>Milena Lessa
                                    <li>Erlon Orlandi
                                    <li>Marcelo Silveira
                                    <li>Caroline Rodrigues
                                    <li>Danielli Crivelaro
                                    <li>Claudio Gaiotti
                                    <li>Edmar Rezende
                                    <li>Luiz Negri
                                    <li>Luiz Negri
                                    <li>Silvio Butiglieri
                                    <li>Maristela Pires
                                    <li>Antonio Cruz	

                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#D81B60">
                                    3 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Katia Rodrigues
                                    <li>Isaac Benzecry
                                    <li>Elisabete Almeida
                                    <li>Fernanda Okubo
                                    <li>Adriana Martins
                                    <li>Ary Silva
                                    <li>Diego Macedo
                                    <li>Ana Monteiro
                                    <li>Patricia Pereira
                                    <li>Ana Almeida
                                    <li>Fernanda Mota
                                    <li>Jose Rocha
                                    <li>Diego Macedo
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#D81B60">
                                    2 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Rafael Goncalves
                                    <li>Benedita Silveira
                                    <li>Flaviane Novaes
                                    <li>Marcelo Moraes
                                    <li>Solange Pedro
                                    <li>Ana Barreiros
                                    <li>Luiz Nascimento
                                    <li>Selir Freitas
                                    <li>Debora Pereira
                                    <li>Sergio Sousa
                                    <li>Flavia Siqueira
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#D81B60">
                                    1 estrela<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Renata Melo
                                    <li>Rodrigo Oliveira
                                    <li>Selmer Grillo
                                    <li>Carla Pereira
                                    <li>Anderson Jesus
                                    <li>Luciane Kuhnen
                                    <li>Celso Watanabe
                                    <li>Fernando Amorim
                                    <li>Joao Filho
                                    <li>Vanessa Janini
                                    <li>Rosilene Silva
                                    <li>Luiz Nascimento
                                    <li>Joao Quintiliano
                                    <li>Ari Bordoni
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="collapse" id="listaBensMoveis">
                    <div class="card card-body card-outline card-purple">
                        <h2 class="card-title"><b>Bens Móveis</b></h2>&nbsp
                        <div class="container">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#605ca8">
                                    5 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Isaac Benzecry
                                    <li>Rodrigo Oliveira
                                    <li>Osmar Junior
                                    <li>Roselene Lins
                                    <li>Flaviane Novaes
                                    <li>Melissa Silva
                                    <li>Jose Oliveira
                                    <li>Diego Macedo
                                    <li>Luciane Kuhnen
                                    <li>Sergio Bonet
                                    <li>Selir Freitas
                                    <li>Thais Almeida
                                    <li>Marcelo Silveira
                                    <li>Vanessa Janini
                                    <li>Isabelle Silva
                                    <li>Fernanda Mendonca
                                    <li>Diego Macedo
                                    <li>Rosilene Silva
                                    <li>Joao Quintiliano
                                    <li>Marcelo Padovese

                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#605ca8">
                                4 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Katia Rodrigues
                                    <li>Fernanda Okubo
                                    <li>Wellington Castro
                                    <li>Ana Barreiros
                                    <li>Luiz Nascimento
                                    <li>Aurino Junior
                                    <li>Ana Monteiro
                                    <li>Patricia Pereira
                                    <li>Luiz Nascimento
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#605ca8">
                                    3 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Camila Coutinho
                                    <li>Elisabete Almeida
                                    <li>Elenisa Ribeiro
                                    <li>Solange Pedro
                                    <li>Edvandro Segantini
                                    <li>Marisa Guerreiro
                                    <li>Danielli Crivelaro
                                    <li>Claudio Gaiotti
                                    <li>Luiz Negri
                                    <li>Silvio Butiglieri
                                    <li>Jose Rocha
                                    <li>Flavia Siqueira
                                    <li>Elias Junior
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#605ca8">
                                    2 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Rafael Goncalves
                                    <li>Renata Melo
                                    <li>Ary Silva
                                    <li>Carla Pereira
                                    <li>Celso Watanabe
                                    <li>Erlon Orlandi
                                    <li>Debora Pereira
                                    <li>Sergio Sousa
                                    <li>Maristela Pires	
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#605ca8">
                                    1 estrela<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Benedita Silveira
                                    <li>Daniel Almeida
                                    <li>Marcelo Moraes
                                    <li>Selmer Grillo
                                    <li>Adriana Martins
                                    <li>Carlos Arruda
                                    <li>Nathaly Shibata
                                    <li>Sandra Dores
                                    <li>Fernando Barros
                                    <li>Emanuel Silva
                                    <li>Anderson Jesus
                                    <li>Mariele Giglioli
                                    <li>Joao Junior
                                    <li>Rosana Oliveira
                                    <li>Rafaela Lopes
                                    <li>Fernando Amorim
                                    <li>Sylvia Pezzuto
                                    <li>Milena Lessa
                                    <li>Diego Lopes
                                    <li>Karina Macacari
                                    <li>Cristiano Carvalho
                                    <li>Fausto Filho
                                    <li>Caroline Rodrigues
                                    <li>Joao Filho
                                    <li>Ana Costa
                                    <li>Vanessa Candioto
                                    <li>Edmar Rezende
                                    <li>Luiz Negri
                                    <li>Tereza Przebeiovicz
                                    <li>Ana Almeida
                                    <li>Fernanda Mota
                                    <li>Ari Bordoni
                                    <li>Alexandre Silva
                                    <li>Antonio Cruz
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="collapse" id="listaInovacao">
                    <div class="card card-body card-outline card-navy">
                        <h2 class="card-title"><b>Inovação / Atendimento / Compliance / RH</b></h2>&nbsp
                        <div class="container">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#001F3F">
                                    5 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Rafael Goncalves
                                    <li>Fernanda Okubo
                                    <li>Camila Coutinho
                                    <li>Renata Melo
                                    <li>Elenisa Ribeiro
                                    <li>Osmar Junior
                                    <li>Marcelo Moraes
                                    <li>Adriana Martins
                                    <li>Jose Oliveira
                                    <li>Sandra Dores
                                    <li>Carla Pereira
                                    <li>Ana Barreiros
                                    <li>Celso Watanabe
                                    <li>Aurino Junior
                                    <li>Sergio Bonet
                                    <li>Joao Filho
                                    <li>Ana Almeida
                                    <li>Flavia Siqueira
                                    <li>Joao Quintiliano
                                    <li>Antonio Cruz	
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#001F3F">
                                4 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star" ></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Isaac Benzecry
                                    <li>Flaviane Novaes
                                    <li>Fernando Barros
                                    <li>Anderson Jesus
                                    <li>Luiz Nascimento
                                    <li>Ana Monteiro
                                    <li>Thais Almeida
                                    <li>Marcelo Silveira
                                    <li>Karina Macacari
                                    <li>Rosilene Silva
                                    <li>Luiz Nascimento
                                    <li>Elias Junior
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#001F3F">
                                    3 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Milena Lessa
                                    <li>Erlon Orlandi
                                    <li>Cristiano Carvalho
                                    <li>Patricia Pereira
                                    <li>Claudio Gaiotti
                                    <li>Isabelle Silva
                                    <li>Fernanda Mendonca
                                    <li>Jose Rocha
                                    <li>Diego Macedo
                                    <li>Alexandre Silva	
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#001F3F">
                                    2 estrelas<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Katia Rodrigues
                                    <li>Daniel Almeida
                                    <li>Rodrigo Oliveira
                                    <li>Wellington Castro
                                    <li>Diego Macedo
                                    <li>Selir Freitas
                                    <li>Caroline Rodrigues
                                    <li>Danielli Crivelaro
                                    <li>Ana Costa
                                    <li>Vanessa Janini
                                    <li>Luiz Negri
                                    <li>Fernanda Mota
                                    <li>Silvio Butiglieri
                                    <li>Sergio Sousa
                                </ul>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <div class="card-header" style="color:#001F3F">
                                    1 estrela<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <ul class="font-weight-normal">
                                    <li>Benedita Silveira
                                    <li>Elisabete Almeida
                                    <li>Roselene Lins
                                    <li>Melissa Silva
                                    <li>Selmer Grillo
                                    <li>Solange Pedro
                                    <li>Ary Silva
                                    <li>Carlos Arruda
                                    <li>Nathaly Shibata
                                    <li>Emanuel Silva
                                    <li>Luciane Kuhnen
                                    <li>Mariele Giglioli
                                    <li>Joao Junior
                                    <li>Rosana Oliveira
                                    <li>Edvandro Segantini
                                    <li>Rafaela Lopes
                                    <li>Fernando Amorim
                                    <li>Marisa Guerreiro
                                    <li>Sylvia Pezzuto
                                    <li>Diego Lopes
                                    <li>Fausto Filho
                                    <li>Debora Pereira
                                    <li>Vanessa Candioto
                                    <li>Edmar Rezende
                                    <li>Luiz Negri
                                    <li>Tereza Przebeiovicz
                                    <li>Ari Bordoni
                                    <li>Marcelo Padovese
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>




       

                <table class="table table-bordered table-striped" id="tblResultado">
                    <thead>                   
                        <tr>
                            <th>Atividade</th>
                            <th>1º Mais Votado</th>
                            <th>2º Mais Votado</th>
                            <th>3º Mais Votado</th> 
                            <th>4º Mais Votado</th> 
                        </tr>
                    </thead>
                    <tbody class="font-weight-normal">

                    </tbody> 
                </table>

            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

    <style>
        .container{
            display: flex;
        }

        a{
            color: white;
        }
    </style>
@stop


@section('js')

    <script src="{{ asset('js/portal/gerencial/resultado-pesquisa-Cepat.js') }}"></script>

@stop
