<style>
 :root {
    --success: #28a745;
    --info: #17a2b8;
    --warning: #ffc107;
    --danger: #dc3545;
}

th {
    text-align: middle;
    font-size: 12px;
}

td{
    font-size: 12px;
}
.apareceMicro{
    display: show;
}
.desapareceMicro{
    display: none;
}
</style>
@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')


@section('saudacao')
<div class="card-header">
    <h3 class="card-title callout callout-info mt-1">
        <span id='unidade'> 7257 </span> - ALIENAR BENS MOV IMOV SAO PAULO, SP 
    </h3>
</div>
    
@endsection


@section('conteudo')
</div>

@if (session('tituloMensagem'))
<div class="card text-white bg-{{ session('corMensagem') }}">
    <div class="card-header">
        <div class="card-body">
            <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
            <br>
            <p class="card-text">{{ session('corpoMensagem') }}</p>
        </div>
    </div>
</div>
@endif
<div class="card-deck">
    <div class="card card-outline card-success" style="background-color: var(--success)">
        <div class="card-body align-middle" style="color:white;">
            <h1 id="" ><strong>116</strong><sup style="font-size: 20px">%</sup></h1>
            <h4 style="text-align:right;">Produtividade</h4>
        </div>
    </div>
    <div class="card card-outline card-success" style="background-color: var(--success)">
        <div class="card-body align-middle" style="color:white;">
            <h1 id="" ><strong>100</strong><sup style="font-size: 20px">%</sup></h1>
            <h4 style="text-align:right;">Desempenho</h4>      
        </div>
    </div>
    <div class="card card-outline card-success" style="background-color: var(--success)">
        <div class="card-body align-middle" style="color:white;">
            <h1 id=""><strong>111</strong><sup style="font-size: 20px">%</sup></h1>
            <h4 style="text-align:right;">Pessoas</h4>    
        </div>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="container"> 
                <h1 id="" style="color: #004c8c"><strong>71</strong><sup style="font-size: 20px">%</sup></h1>
                <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
            </div>
            <a data-toggle="collapse" aria-expanded="false" aria-controls="listaFTE" href="#listaFTE" class="small-box-footer float-right" role="button" id="listagemFTE"><i id="iconeFTE" class="fa fa-angle-down" style="color: #004c8c"></i></a>       
        </div>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-body align-middle">
            <h1 id="" style="color: #004c8c"><strong>171</strong></h1>
            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>    
        </div>
    </div>
</div>

<br>

<div class="collapse" id="listaFTE">
    <div class="card card-body card-outline">
        <div class="d-flex justify-content-start" style="color: #48586c">
            <h2 class="card-title"><b>FTE - Detalhamento</b></h2>&nbsp&nbsp&nbsp
        </div>
        <div class="col-sm-12" style="color: #48586C">
            <div class="card-deck">
                <div class="card border-0">
                    <div class="card-body align-middle" style="background-color: #d0e0e3">
                        <h4 id="" style="color: #48586c"><strong>47,18</strong></h4>
                        <p style="text-align:right; color: #48586c">FTE Técnico Total</p>      
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle" style="background-color: #d0e0e3">
                        <h4 id="" style="color: #48586c"><strong>11,72</strong></h4>
                        <p style="text-align:right; color: #48586c">FTE Técnico Mensurável</p>    
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle" style="background-color: #d0e0e3">
                        <h4 id="" style="color: #48586c"><strong>79</strong></h4>
                        <p style="text-align:right; color: #48586c">FTE Técnico Não Mensurável</p>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle" style="background-color: #d0e0e3">
                        <h4 id="" style="color: #48586c"><strong>12</strong></h4>
                        <p style="text-align:right; color: #48586c">Gestores</p>     
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle" style="background-color: #d0e0e3">
                        <h4 id="" style="color: #48586c"><strong>4</strong></h4>
                        <p style="text-align:right; color: #48586c">Afastados</p>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-start" style="color: #004c8c">
            <h4 style="font-size:22px;" id="macroprocesso_nome"><b>Macroprocesso:</b>&nbsp&nbsp<span>Elaboração subsídios para Defesa da Caixa, Manifestação de laudos periciais e Atendimento a peritos judiciais</span></h4>
        </div>
        <div class="col-md-12" style="color: #5f758f">
            <div class="table-responsive">
                <table class="table table-super-condensed table-hover table-sm">
                <thead>
                        <tr>
                            <th></th>
                            <th class="align-middle">Volume total<br><small class="text-muted">mês</small></th>
                            <th class="align-middle">Volume realizado<br><small class="text-muted">mês</small></th> 
                            <th class="align-middle">Tempo médio histórico<br><small class="text-muted">minutos</small></th> 
                            <th class="align-middle">Tempo médio realizado<br><small class="text-muted">minutos</small></th>
                            <th class="align-middle">Pessoas alocadas<br><small class="text-muted">qtdade</small></th>
                            <th class="align-middle">Desempenho<br><small class="text-muted">%</small></th>
                            <th class="align-middle">Tempo<br><small class="text-muted">%</small></th>
                            <th class="align-middle">Capacidade de produção<br><small class="text-muted">%</small></th>
                            <th class="align-middle">Pessoas para realizar Estoque<br><small class="text-muted">%</small></th>
                            <th class="align-middle">Produtividade<br><small class="text-muted">Volume/Tempo</small></th>
                            <th class="align-middle">Pessoas necessárias para realizar Estoque<br><small class="text-muted">qtdade</small></th>
                            <th class="align-middle">Tempo médio necessário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="totMacro" class="atendimentos" style="color: #004c8c">
                            <td style="white-space: nowrap;"><b>Total Macroprocesso</b>  <span>+</span></td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>
              

                        <tr class="ativ" id="atividadeVolumosa" style="display: none">
                            <td style="color: #F39200;">Atividades Volumosas  <span>+</span></td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>

                        <tr class="microVol" style="display: none">
                            <td style="color: #54BBAB;">Microprocesso XXXX</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>

                        <tr class="microVol" style="display: none">
                            <td style="color: #54BBAB;">Microprocesso XXXX</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>

                        <tr class="microVol" style="display: none">
                            <td style="color: #54BBAB;">Microprocesso XXXX</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>
                        
                        <tr class="ativ" style="display: none">
                            <td style="color: #F39200;">Atividades Complexas/Críticas  <span>+</span></td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>
                        <tr class="ativ" style="display: none">
                            <td style="color: #F39200;">Atividades Manuais  <span>+</span></td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>
                        <tr class="ativ" style="display: none">
                            <td style="color: #F39200;">Atividades Automatizadas  <span>+</span></td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>
                        <tr  class="ativ" style="display: none">
                            <td style="color: #F39200;">Atividades Secundárias  <span>+</span></td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                            <td>valor</td>
                        </tr>

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/produtividade/produtividade-vilop-relatorio.js') }}"></script>

@endsection

@section('css')


@endsection