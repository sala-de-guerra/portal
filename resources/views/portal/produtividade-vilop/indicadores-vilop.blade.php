<style>
 :root {
  --level-1: #EFF5F6;
  --level-2: #EFF5F6;
  --level-3: #EFF5F6;
  --level-4: #EFF5F6;
  --level-5: #EFF5F6;
  --level-6: #b3c7cb;
  --black: #d0e0e3;
  --white: white;
}
h1{
    font-size: 36px;
}
h2{
    font-size: 24px;
 }
h3{
    font-size: 18px;
}
h4{
    font-size: 16px;
}
h5{
    font-size:14px;
    color: white;
}
a:link {
  text-decoration: none;
  
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

ol {
  list-style: none;
}

body {
  margin: 50px 0 100px;
  text-align: center;
  font-family: "Inter", sans-serif;
}

.container {
  max-width: 1000px;
  padding: 10px 10px;
  margin: 0 auto;
}

.rectangle {
  position: relative;
  padding: 5px 5px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  color: white;
  border-radius: 5px 5px 5px 5px;
  text-align: center;
  cursor:pointer;
}


/* LEVEL-1 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-1 {
  width: 50%;
  margin: 0 auto 40px;
  background: var(--level-1);
  font-size: 36px;
  color: #b3c7cb;
}

.level-1::before {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 20px;
  background: var(--black);
  border-radius: 5px;
}

.level-1 li a:hover, .level-1 li a:hover+ul li a {
    transform: scale(1.1); 
}

/* LEVEL-2 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-2-wrapper {
  position: relative;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.level-2-wrapper::before {
  content: "";
  position: absolute;
  top: -20px;
  left: 25%;
  width: 50%;
  height: 2px;
  background: var(--black);
}

.level-2-wrapper::after {
  display: none;
  content: "";
  position: absolute;
  left: -20px;
  bottom: -20px;
  width: calc(100% + 20px);
  height: 2px;
  background: var(--black);
}

.level-2-wrapper li {
  position: relative;
}

.level-2-wrapper > li::before {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 20px;
  background: var(--black);
}

.level-2 {
  width: 70%;
  margin: 0 auto 40px;
  background: var(--level-2);
  font-size: 24px;
  color: #b3c7cb;
}

.level-2::before {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 20px;
  background: var(--black);
}

.level-2::after {
  display: none;
  content: "";
  position: absolute;
  top: 50%;
  left: 0%;
  transform: translate(-100%, -50%);
  width: 20px;
  height: 2px;
  background: var(--black);
}


/* LEVEL-3 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-3A-wrapper{
  position: relative;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-column-gap: 20px;
  width: 90%;
  margin: 0 auto;
}

.level-3B-wrapper{
  position: relative;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-column-gap: 20px;
  width: 100%;
  margin: 0 auto;
}

.level-3A-wrapper::before {
  content: "";
  position: absolute;
  top: -20px;
  left: calc(25% - 5px);
  width: calc(50% + 10px);
  height: 2px;
  background: var(--black);
}

.level-3B-wrapper::before {
  content: "";
  position: absolute;
  top: -20px;
  right: auto;
  left: calc(15%);
  width: calc(50% + 115px);
  height: 2px;
  background: var(--black);
}

.level-3A-wrapper > li::before {
  content: "";
  position: absolute;
  top: 0;
  left: 50%;
  transform: translate(-50%, -100%);
  width: 2px;
  height: 20px;
  background: var(--black);
}

.level-3B-wrapper > li::before {
  content: "";
  position: absolute;
  top: 0;
  left: 50%;
  transform: translate(-50%, -100%);
  width: 2px;
  height: 20px;
  background: var(--black);
}
.level-3 {
  margin-bottom: 20px;
  background: var(--level-3);
  color: #b3c7cb;
  font-size: 18px;
}


/* LEVEL-4 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-4-wrapper {
  position: relative;
  width: 80%;
  margin-left: auto;
}

.level-4-wrapper::before {
  content: "";
  position: absolute;
  top: -20px;
  left: -20px;
  width: 2px;
  height: 100%;
  background: var(--black);
}

.level-4-wrapper li + li {
  margin-top: 20px;
}

.level-4 {
  font-weight: normal;
  background: var(--level-4);
  font-size: 16px;
  color: #b3c7cb;
}

.level-4::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0%;
  transform: translate(-100%, -50%);
  width: 20px;
  height: 2px;
  background: var(--black);
}
/* LEVEL-4 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-4B-wrapper {
  position: relative;
  width: 80%;
  margin-left: auto;
}

.level-4B-wrapper::before {
  content: "";
  position: absolute;
  top: -20px;
  left: -20px;
  width: 2px;
  height: 95%;
  background: var(--black);
}

.level-4B-wrapper li + li {
  margin-top: 20px;
}

.level-4B {
  font-weight: normal;
  background: var(--level-4);
  font-size: 16px;
  color: #b3c7cb;
}

.level-4B::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0%;
  transform: translate(-100%, -50%);
  width: 20px;
  height: 2px;
  background: var(--black);
}

.level-4B li:only-child::after, .level-4B li:only-child::before {
	background: var(--white);
}

.level-4B li:first-child::before, .level-4B li:last-child::after{
	background: var(--white);
}

.level-5-wrapper {
  padding-top: 0px;
  position: relative;
  width: 80%;
  margin-left: auto;
}

.level-5-wrapper::before {
  content: "";
  position: absolute;
  top: 0px;
  left: -20px;
  width: 2px;
  height: 90%;
  background: var(--black);
}

.level-5-wrapper li + li {
  margin-top: 10px;
}

.level-5 {
  font-weight: normal;
  background: var(--level-5);
  font-size: 14px;
  color: #b3c7cb;
}

.level-5::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0%;
  transform: translate(-100%, -50%);
  width: 20px;
  height: 2px;
  background: var(--black);
}

.level-5 li:only-child::after, .level-5 li:only-child::before {
	background: var(--white);
}

.level-5 li:first-child::before, .level-5 li:last-child::after{
	background: var(--white);
}

.level-6-wrapper {
  padding-top: 10px;
  position: relative;
  width: 80%;
  margin-left: auto;
}

.level-6-wrapper::before {
  content: "";
  position: absolute;
  top: 0px;
  left: -20px;
  width: 2px;
  height: calc(100% + 20px);
  background: var(--black);
}

.level-6-wrapper li + li {
  margin-top: 10px;
}

.level-6 {
  font-weight: normal;
  background: var(--level-6);
}

.level-6::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0%;
  transform: translate(-100%, -50%);
  width: 20px;
  height: 2px;
  background: var(--black);
}

/* MQ STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
@media screen and (max-width: 700px) {
  .rectangle {
    padding: 20px 10px;
  }

  .level-1,
  .level-2 {
    width: 100%;
  }

  .level-1 {
    margin-bottom: 20px;
  }

  .level-1::before,
  .level-2-wrapper > li::before {
    display: none;
  }
  
  .level-2-wrapper,
  .level-2-wrapper::after,
  .level-2::after {
    display: block;
  }

  .level-2-wrapper {
    width: 90%;
    margin-left: 10%;
  }

  .level-2-wrapper::before {
    left: -20px;
    width: 2px;
    height: calc(100% + 40px);
  }

  .level-2-wrapper > li:not(:first-child) {
    margin-top: 50px;
  }
}
.card-title{
    background-color: white !important;
}

.level-5 > span:hover{
    display: show;
}

.legenda{
       color: #48586c;
       font-size: 13px;
       text-align:right;
   }

</style>
@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')

@section('saudacao')
<div class="card-header">
    <h3 class="card-title callout callout-info mt-1">
         VILOP
    </h3>
</div>
@endsection

@section('conteudo')
</div>
@if (session('tituloMensagem'))
<div class="card text-white bg-{{ session('corMensagem') }}">
    <div class="card-header">
        <div class="card-body" style="display: none;" id="">
            <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
            <br>
            <p class="card-text">{{ session('corpoMensagem') }}</p>
        </div>
    </div>
</div>
@endif
<div class="row"> 
    <div class="col-md-12">
        <div class="card">
            <div class="container">
                <a data-toggle="modal" data-target="#modal5807"><h1 class="level-1 rectangle" id="botao5807"><span id="sigla5807">VILOP</span><br><span id="nome5807" style="display: none;">VP Logística e Operações</span></h1></a>

                <!--Modal VILOP-->
                <div class="modal fade bd-example-modal-xl" id="modal5807" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#005ca9; color:white;">
                                <h4 class="modal-title" id="exampleModalLabel"> <span id="vice5807">5807</span> - <span id="siglaVice5807">VILOP</span></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="color: #5f758f" id="unidadeSemNenhumDado5807">Esta unidade não possui dados de indicadores.</p>
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body" style="display: none;" id="prodUnidade5807">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body" style="display: none;" id="desUnidade5807">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                        </div>
                                    </div>  
                                    <div class="card">
                                        <div class="card-body" style="display: none;" id="fteUnidade5807">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body" style="display: none;" id="lapUnidade5807">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                        </div>
                                    </div>
                                    <div class="card"  style="display: none;" id="corUnidade5807">                                                       
                                        <div class="card-body align-middle">
                                            <h4><span id="resultado5807"></span></h4>
                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <ol class="level-2-wrapper">
                    <li class="subVilop" id="deopc">
                        <a data-toggle="modal" data-target="#modal5016"><h2 class="level-2 rectangle" id="botao5016"><span id="sigla5016" >DEOPC</span><br><span id="nome5016" style="display: none;">DE Operações e Contratos</span></h2></a>
                        
                            <!--Modal DEOPC-->

                        <div class="modal fade bd-example-modal-xl" id="modal5016" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#f39200; color:white;">
                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="diretoria5016">5016</span> - <span id="siglaDiretoria5016">DEOPC</span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <p style="color: #5f758f" id="unidadeSemNenhumDado5016">Esta unidade não possui dados de indicadores.</p>
                                        <div class="card-deck">
                                            
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="prodUnidade5016">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="desUnidade5016">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                </div>
                                            </div>  
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="fteUnidade5016">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="lapUnidade5016">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                </div>
                                            </div>
                                            <div class="card"  style="display: none;" id="corUnidade5016">                                                          
                                                <div class="card-body align-middle">
                                                    <h4><span id="resultado5016"></span></h4>
                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <ol class="level-3A-wrapper">
                            <li class="subDeopc" id="sucot">
                                <a data-toggle="modal" data-target="#modal5061"><h3 class="level-3 rectangle" id="botao5061"><span id="sigla5061">SUCOT</span><br><span id="nome5061" style="display: none;">SN Contratos</span></h3></a>

                                <!--Modal SUCOT-->

                                <div class="modal fade bd-example-modal-xl" id="modal5061" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="super5061">5061</span> - <span id="siglaSuper5061">SUCOT</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <p style="color: #5f758f" id="unidadeSemNenhumDado5061">Esta unidade não possui dados de indicadores.</p>
                                                <div class="card-deck">
                                                    
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="prodUnidade5061">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="desUnidade5061">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="fteUnidade5061">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="lapUnidade5061">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card"  style="display: none;" id="corUnidade5061">                                                          
                                                        <div class="card-body align-middle">
                                                            <h4><span id="resultado5061"></span></h4>
                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <ol class="level-4-wrapper">
                                    <li class="subSucot" id="Gefop">
                                        <a data-toggle="modal" data-target="#modal5532"><h4 class="level-4 rectangle" id="botao5532"><span id="sigla5532">GEFOP</span><br><span id="nome5532" style="display: none;">GN Gestão Formal Contratos e Pagamentos</span></h4></a>
                                        
                                        <!-- Modal GEFOP-->
                                        <div class="modal fade bd-example-modal-xl" id="modal5532" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5532">5532</span> - <span id="siglaGerencia5532">GEFOP</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5532">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5532">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5532">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5532">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5532">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5532">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5532"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <ol class="level-5-wrapper">
                                            <li class="coluna">
                                                <a data-toggle="modal" data-target="#modal5625"><h5 class="level-5 rectangle" id="botao5625"><span id="sigla5625">CEFOR</span><br><span id="nome5625" style="display: none;">CN Gestão Formal de Contratos</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal5625" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora5625">5625</span> - <span id="nomeCentralizadora5625">CEFOR</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/5625">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5625">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade5625">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade5625">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade5625">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade5625">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade5625">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado5625"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="coluna">
                                                <a data-toggle="modal" data-target="#modal5568"><h5 class="level-5 rectangle" id="botao5568"><span id="sigla5568">CEPAG</span><br><span id="nome5568" style="display: none;">CN Pagamentos de Contratos</span></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal5568" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora5568">5568</span> - <span id="nomeCentralizadora5568">CEPAG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/5568">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5568">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade5568">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade5568">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade5568">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade5568">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade5568">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado5568"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="subSucot" id="Gecot">
                                        <a data-toggle="modal"  data-target="#modal5307"><h4 class="level-4 rectangle" id="botao5307"><span id="sigla5307">GECOT</span><br><span id="nome5307" style="display: none;">GN Contratos</span></h4></a>
                                        
                                        
                                        <div class="modal fade bd-example-modal-xl" id="modal5307" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5307">5307</span> - <span id="siglaGerencia5307">GECOT</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5307">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5307">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5307">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5307">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5307">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5307">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5307"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="Cecot">
                                                <a data-toggle="modal" data-target="#modal5688"><h5 class="level-5 rectangle" id="botao5688"><span id="sigla5688">CECOT</span><br><span id="nome5688" style="display: none;">CN Contratos</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal5688" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora5688">5688</span> - <span id="nomeCentralizadora5688">CECOT</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/5688">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5688">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade5688">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade5688">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade5688">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade5688">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade5688">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado5688"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li class="subDeopc" id="suban">
                                <a data-toggle="modal"  data-target="#modal5032"><h3 class="level-3 rectangle" id="botao5032"><span id="sigla5032">SUBAN</span><br><span id="nome5032" style="display: none;">SN Operações Bancárias</span></h3></a>

                                <!-- Modal SUBAN-->
                                <div class="modal fade bd-example-modal-xl" id="modal5032" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="super5032">5032</span> - <span id="siglaSuper5032">SUBAN</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5032">Esta unidade não possui dados de indicadores.</p>
                                                <div class="card-deck">
                                                
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="prodUnidade5032">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="desUnidade5032">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="fteUnidade5032">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="lapUnidade5032">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card"  style="display: none;" id="corUnidade5032">                                                          
                                                        <div class="card-body align-middle">
                                                            <h4><span id="resultado5032"></span></h4>
                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <ol class="level-4B-wrapper">
                                    <li class="subSuban" id="geban">
                                        <a data-toggle="modal" data-target="#modal5402"><h4 class="level-4B rectangle" id="botao5402"><span id="sigla5402">GEBAN</span><br><span id="nome5402" style="display: none;">GN Processos Bancários</span></h4></a>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modal5402" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5402">5402</span> - <span id="siglaGerencia5402">GEBAN</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5402">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5402">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5402">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5402">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5402">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                </div>
                                                            </div>
                                                            <div class="card" style="display: none;" id="corUnidade5402">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5402"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <ol class="level-5-wrapper">
                                            <li class="subGeban">
                                                <a data-toggle="modal"  data-target="#modal7822"><h5 class="level-5 rectangle" id="botao7822"><span id="sigla7822">CECOM</span><br><span id="nome7822" style="display: none;">CN Compensação Cheque e Outros Papéis</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7822" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7822">7822</span> - <span id="nomeCentralizadora7822">CECOM</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7822">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7822">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7822">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7822">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7822">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7822">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7822">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7822"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGeban">
                                                <a data-toggle="modal"  data-target="#modal7009"><h5 class="level-5 rectangle" id="botao7009"><span id="sigla7009">CEDIP</span><br><span id="nome7009" style="display: none;">CN Dados e Inteligência em Op. Bancárias</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7009" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7009">7009</span> - <span id="nomeCentralizadora7009">CEDIP</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7009">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7009">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7009">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7009">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7009">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7009">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7009">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7009"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li class="subSuban" id="geope">
                                        <a data-toggle="modal" data-target="#modal5401" ><h4 class="level-4B rectangle" id="botao5401"><span id="sigla5401">GEOPE</span><br><span id="nome5401"style="display: none;">GN Operações Bancárias</span></h4></a>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modal5401" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5401">5401</span> - <span id="siglaGerencia5401">GEOPE</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5401">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5401">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5401">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5401">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5401">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5401">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5401"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li class="subGeope">
                                                <a data-toggle="modal" data-target="#modal7330"><h5 class="level-5 rectangle" id="botao7330"><span id="sigla7330">CECOV</span><br><span id="nome7330" style="display: none;">CN Convênios</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7330" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7330">7330</span> - <span id="nomeCentralizadora7330">CECOV</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7330">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7330">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7330">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7330">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7330">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7330">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7330">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7330"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            <li class="subGeope">
                                                <a data-toggle="modal" data-target="#modal7008"><h5 class="level-5 rectangle" id="botao7008"><span id="sigla7008">CEPOC</span><br><span id="nome7008" style="display: none;">CN Operações de Portabilidade</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7008" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7008">7008</span> - <span id="nomeCentralizadora7008">CEPOC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7008">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7008">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7008">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7008">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7008">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7008">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7008">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7008"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            <li class="subGeope" id="ceope">
                                                <a data-toggle="modal" ><h5 class="level-5 rectangle" style="background-color: #5f758f; color: white"><span id="">CEOPE</span><br><span style="display: none;">CN Operações Bancárias</span></h5></a>

                                                <div class="list-group" id="listaCeope" style="display: none;">
                                                    
                                                    <a data-toggle="modal" data-target="#modal7829"><h6  class="list-group-item list-group-item-action" id="botao7829" style="font-size: 12px; padding: 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7829">CEOPE / BU</span><br><span id="nome7829" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7740"><h6  class="list-group-item list-group-item-action" id="botao7740" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7740">CEOPE / BE</span><br><span id="nome7740" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7764"><h6 class="list-group-item list-group-item-action" id="botao7764" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7764">CEOPE / BH</span><br><span id="nome7764" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7010"><h6  class="list-group-item list-group-item-action" id="botao7010" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7010">CEOPE / CT</span><br><span id="nome7010" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7011"><h6  class="list-group-item list-group-item-action" id="botao7011" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7011">CEOPE / FO</span><br><span id="nome7011" style="display: none;">CN Operações Bancárias</span></h6></a>
                                            
                                                    <a data-toggle="modal" data-target="#modal7790"><h6  class="list-group-item list-group-item-action" id="botao7790" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span  id="sigla7790">CEOPE / PO</span><br><span id="nome7790" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7758"><h6  class="list-group-item list-group-item-action" id="botao7758" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span  id="sigla7758">CEOPE / RE</span><br><span id="nome7758" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7838"><h6  class="list-group-item list-group-item-action" id="botao7838" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span  id="sigla7838">CEOPE / RJ</span><br><span id="nome7838" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7844"><h6  class="list-group-item list-group-item-action" id="botao7844" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span  id="sigla7844">CEOPE / SP</span><br><span id="nome7844" style="display: none;">CN Operações Bancárias</span></h6></a>
                                                    
                                                </div>
                                                
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modal7829" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7829">7829</span> - <span id="nomeCentralizadora7829">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7829">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7829">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7829">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7829">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7829">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7829">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7829">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7829"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7740" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7740">7740</span> - <span id="nomeCentralizadora7740">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7740">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7740">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7740">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7740">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7740">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7740">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7740">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7740"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7764" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7764">7764</span> - <span id="nomeCentralizadora7764">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7764">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7764">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7764">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7764">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7764">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7764">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7764">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7764"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7010" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7010">7010</span> - <span id="nomeCentralizadora7010">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7010">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7010">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7010">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7010">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7010">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7010">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7010">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7010"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7011" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7011">7011</span> - <span id="nomeCentralizadora7011">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7011">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7011">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7011">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7011">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7011">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7011">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7011">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7011"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7790" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7790">7790</span> - <span id="nomeCentralizadora7790">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7790">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7790">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7790">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7790">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7790">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7790">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7790">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7790"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7758" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"  > <span id="centralizadora7758">7758</span> - <span id="nomeCentralizadora7758">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>               
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7758">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7758">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7758">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7758">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7758">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7758">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7758">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7758"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7838" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7838">7838</span> - <span id="nomeCentralizadora7838">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7838">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7838">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7838">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7838">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7838">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7838">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7838">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7838"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7844" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7844">7844</span> - <span id="nomeCentralizadora7844">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7844">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7844">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7844">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7844">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7844">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7844">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7844">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7844"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                        </ol>
                                    </li>
                                    <li  class="subSuban" id="gemob">
                                        <a data-toggle="modal" data-target="#modal5517"><h4 class="level-4B rectangle" id="botao5517"><span id="sigla5517">GEMOB</span><br><span id="nome5517" style="display: none;">GN Manutenção de Op. Bancárias</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5517" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5517">5517</span> - <span id="siglaGerencia5517">GEMOB</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5517">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5517">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5517">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5517">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5517">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5517">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5517"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li class="subGemob">
                                                <a data-toggle="modal" data-target="#modal7017"><h5 class="level-5 rectangle" id="botao7017"><span id="sigla7017">CEMOB</span><br><span id="nome7017" style="display: none;">CN Manutenção Op. Bancárias</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7017" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7017">7017</span> - <span id="nomeCentralizadora7017">CEMOB</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7017">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7017">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7017">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7017">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7017">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7017">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7017">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7017"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGemob">
                                                <a data-toggle="modal" data-target="#modal7014"><h5 class="level-5 rectangle" id="botao7014"><span id="sigla7014">CEMOC</span><br><span id="nome7014" style="display: none;">CN Manutenção Op. C. Consignado</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7014" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7014">7014</span> - <span id="nomeCentralizadora7014">CEMOC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7014">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7014">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7014">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7014">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7014">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7014">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7014">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7014"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGemob" id="cecoq">
                                                <a data-toggle="modal" ><h5 class="level-5 rectangle" style="background-color: #5f758f; color: white">CECOQ<span style="display: none;">CN Conciliação e Qualificação de Transações</span></h5></a>

                                                <div class="list-group" style="display: none;" id="listaCecoq">
                                                    
                                                    <a data-toggle="modal" data-target="#modal7823"><h6 class="list-group-item  list-group-item-action" id="botao7823" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7823">CECOQ / CP</span><br><span id="nome7823" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>

                                                    <a data-toggle="modal" data-target="#modal7772"><h6 class="list-group-item  list-group-item-action"  id="botao7772" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7772">CECOQ / CG</span><br><span id="nome7772" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7804"><h6 class="list-group-item  list-group-item-action"  id="botao7804" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7804">CECOQ / CT</span><br><span id="nome7804" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7723"><h6 class="list-group-item  list-group-item-action" id="botao7723" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7723">CECOQ / FO</span><br><span id="nome7723" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7743"><h6 class="list-group-item  list-group-item-action" id="botao7743" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7743">CECOQ / GO</span><br><span id="nome7743" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modalCecoq_SA"><h6 class="list-group-item  list-group-item-action" id="botao7777" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla">CECOQ / SA</span><br><span id="nome" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7824"><h6 class="list-group-item  list-group-item-action" id="botao7824" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7824">CECOQ / SP</span><br><span id="nome7824" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7736"><h6 class="list-group-item  list-group-item-action" id="botao7736" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7736">CECOQ / VT</span><br><span id="nome7736" style="display: none;">CN Conciliação e Qualificação de Transações</span></h6></a>
                                                
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7823" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7823">7823</span> - <span id="nomeCentralizadora7823">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7823">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7823">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7823">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7823">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7823">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7823">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7823">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7823"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7772" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7772">7772</span> - <span id="nomeCentralizadora7772">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7772">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7772">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7772">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7772">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7772">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7772">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7772">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7772"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7804" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7804">7804</span> - <span id="nomeCentralizadora7804">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7804">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7804">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7804">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7804">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7804">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7804">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7804">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7804"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7723" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7723">7723</span> - <span id="nomeCentralizadora7723">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7723">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7723">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7723">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7723">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7723">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7723">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7723">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7723"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7743" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7743">7743</span> - <span id="nomeCentralizadora7743">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7743">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7743">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7743">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7743">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7743">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7743">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7743">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7743"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_SA" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora"></span> - <span id="nomeCentralizadora">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7777">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7777">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7777"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7777">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7777"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7777">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7777"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7777">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7777"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7777">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7777"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7824" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7824">7824</span> - <span id="nomeCentralizadora7824">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7824">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7824">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7824">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7824">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7824">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7824">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7824">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7824"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7736" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7736">7736</span> - <span id="nomeCentralizadora7736">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7736">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7736">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7736">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7736">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7736">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7736">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7736">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7736"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="subGemob">
                                                <a data-toggle="modal" data-target="#modal7253"><h5 class="level-5 rectangle" id="botao7253"><span id="sigla7253">CEMAB</span><br><span id="nome7253" style="display: none;">CN Manutenção p/ Alienação de Bens</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7253" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7253">7253</span> - <span id="nomeCentralizadora7253">CEMAB</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7253">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7253">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7253">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7253">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7253">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7253">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7253">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7253"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li  class="subSuban" id="geotn">
                                        <a data-toggle="modal" data-target="#modal5510"><h4 class="level-4B rectangle" id="botao5510"><span id="sigla5510">GEOTN</span><br><span id="nome5510" style="display: none;">GN Operações de Tesouraria e Numerário</span></h4></a>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modal5510" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5510">5510</span> - <span id="siglaGerencia5510">GEOTN</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p style="color: #5f758f" id="unidadeSemNenhumDado5510">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5510">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5510">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5510">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5510">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" style="display: none;" id="corUnidade5510">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5510"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li class="subGeotn">
                                                <a data-toggle="modal" data-target="#modal7012"><h5 class="level-5 rectangle" id="botao7012"><span id="sigla7012">CELCC</span><br><span id="nome7012" style="display: none;">CN Liquidação, Custódia e Câmbio</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7012" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7012">7012</span> - <span id="nomeCentralizadora7012">CELCC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7012">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7012">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7012">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7012">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7012">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7012">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7012">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7012"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGeotn">
                                                <a data-toggle="modal" data-target="#modal7854"><h5 class="level-5 rectangle" id="botao7854"><span id="sigla7854">CEOPN</span><br><span id="nome7854" style="display: none;">CN Operações de Numerário</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7854" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7854">7854</span> - <span id="nomeCentralizadora7854">CEOPN</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7854">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7854">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7854">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7854">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7854">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7854">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7854">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7854"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li  class="subSuban" id="gesec">
                                        <a data-toggle="modal" data-target="#modal5516"><h4 class="level-4B rectangle" id="botao5516"><span id="sigla5516">GESEC</span><br><span id="nome5516" style="display: none;">GN Serviços de Op. Bancárias e Carteiras</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5516" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5516">5516</span> - <span id="siglaGerencia5516">GESEC</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5516">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5516">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5516">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5516">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5516">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5516">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5516"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li class="subGesec">
                                                <a data-toggle="modal" data-target="#modal7016"><h5 class="level-5 rectangle" id="botao7016" ><span id="sigla7016">CESEC</span><br><span id="nome7016" style="display: none;">CN Serviços de Op. Bancárias e Carteiras</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7016" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7016">7016</span> - <span id="nomeCentralizadora7016">CESEC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7016">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7016">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7016">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7016">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7016">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7016">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7016">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7016"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <a data-toggle="modal"  data-target="#modal7786"><h5 class="level-5 rectangle" id="botao7786"><span id="sigla7786">CESIG</span><br><span id="nome7786" style="display: none;">CN Sigilo Bancário</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7786" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7786">7786</span> - <span id="nomeCentralizadora7786">CESIG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7786">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7786">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7786">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7786">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7786">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7786">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7786">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7786"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <a data-target="#modal7077" data-toggle="modal"><h5 class="level-5 rectangle" id="botao7077"><span id="sigla7077">CEPAT</span><br><span id="nome7077" style="display: none;">CN Patrimônio e Bens de Terceiros</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7077" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7077">7077</span> - <span id="nomeCentralizadora7077">CEPAT</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7077">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7077">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7077">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7077">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7077">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7077">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7077">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7077"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <a data-toggle="modal"  data-target="#modal7251"><h5 class="level-5 rectangle" id="botao7251"><span id="sigla7251">CEVEN</span><br><span id="nome7251" style="display: none;">CN Vendas de Bens</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7251" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7251">7251</span> - <span id="nomeCentralizadora7251">CEVEN</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7251">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7251">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7251">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7251">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7251">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7251">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7251">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7251"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <a data-toggle="modal" data-target="#modal7015"><h5 class="level-5 rectangle" id="botao7015"><span id="sigla7015">CEDIC</span><br><span id="nome7015" style="display: none;">CN Recuperação de Direitos Creditórios</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7015" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7015">7015</span> - <span id="nomeCentralizadora7015">CEDIC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7015">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7015">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7015">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7015">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7015">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7015">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7015">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7015"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li class="subVilop" id="delos">
                        <a data-toggle="modal"  data-target="#modal5119"><h2 class="level-2 rectangle" id="botao5119"><span id="sigla5119">DELOS</span><br><span id="nome5119" style="display: none;">DE Logística e Segurança</span></h2></a>

                        <!--Modal DELOS-->
                        <div class="modal fade bd-example-modal-xl" id="modal5119" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#f39200; color:white;">
                                    <h4 class="modal-title" id="exampleModalLabel"> <span id="diretoria5119">5119</span> - <span id="siglaDiretoria5119">DELOS</span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <p style="color: #5f758f" id="unidadeSemNenhumDado5119">Esta unidade não possui dados de indicadores.</p>
                                        <div class="card-deck">
                                        
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="prodUnidade5119">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="desUnidade5119">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                </div>
                                            </div>  
                                        
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="fteUnidade5119">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body" style="display: none;" id="lapUnidade5119">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                </div>
                                            </div>
                                            <div class="card" style="display: none;" id="corUnidade5119">
                                                <div class="card-body align-middle">
                                                    <h4><span id="resultado5119"></span></h4>
                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <ol class="level-3B-wrapper">
                            <li id="">
                                <a data-toggle="modal"  data-target="#modal5173"><h3 class="level-3 rectangle" id="botao5173"><span id="sigla5173">SUCPA</span><br><span id="nome5173" style="display: none;">SN Compras</span></h3></a>

                                <!-- Modal SUCPA-->
                                <div class="modal fade bd-example-modal-xl" id="modal5173" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="super5173">5173</span> - <span id="siglaSuper5173">SUCPA</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5173">Esta unidade não possui dados de indicadores.</p>
                                                <div class="card-deck">
                                                
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="prodUnidade5173">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="desUnidade5173">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="fteUnidade5173">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="lapUnidade5173">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                        </div>
                                                    </div>
                                                    <div class="card"  style="display: none;" id="corUnidade5173">
                                                        <div class="card-body align-middle">
                                                            <h4><span id="resultado5173"></span></h4>
                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5334"><h4 class="level-4 rectangle" id="botao5334"><span id="sigla5334">GECPE</span><br><span id="nome5334" style="display: none;">GN Compras de Gestão de Pessoas</span></h4></a>

                                       
                                        <div class="modal fade bd-example-modal-xl" id="modal5334" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5334">5334</span> - <span id="siglaGerencia5334">GECPE</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p style="color: #5f758f" id="unidadeSemNenhumDado5334">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="´prodUnidade5334">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5334">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5334">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5334">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5334">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5334"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal"  data-target="#modal7088"><h5 class="level-5 rectangle" id="botao7088"><span id="sigla7088">CECPE</span><br><span id="nome7088" style="display: none;">CN Compras de Gestão de Pessoas</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7088" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7088">7088</span> - <span id="nomeCentralizadora7088">CECPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7088">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7088">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7088">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7088">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7088">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7088">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7088">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7088"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li id="">
                                        <a data-toggle="modal"  data-target="#modal7079"><h4 class="level-4 rectangle" id="botao7079"><span id="sigla7079">GECMA</span><br><span id="nome7079" style="display: none;">GN Compras de Marketing</span></h4></a>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modal7079" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia7079">7079</span> - <span id="siglaGerencia7079">GECMA</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p style="color: #5f758f" id="unidadeSemNenhumDado7079">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade7079">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade7079">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade7079">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade7079">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade7079">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado7079"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7081"><h5 class="level-5 rectangle" id="botao7081"><span id="sigla7081">CECMA</span><br><span id="nome7081" style="display: none;">CN Compras de Marketing</span></h5></a>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modal7081" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7081">7081</span> - <span id="nomeCentralizadora7081">CECMA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7081">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7081">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7081">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7081">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7081">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7081">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7081">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7081"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>

                                    </li>

                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5427"><h4 class="level-4 rectangle" id="botao5427"><span id="sigla5427">GECPA</span><br><span id="nome5427" style="display: none;">GN Compras</span></h4></a>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modal5427" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5427">5427</span> - <span id="siglaGerencia5427">GECPA</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p style="color: #5f758f" id="unidadeSemNenhumDado5427">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5427">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5427">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5427">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5427">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" style="display: none;" id="corUnidade5427">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5427"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7083"><h5 class="level-5 rectangle" id="botao7083"><span id="sigla7083">CECPA</span><br><span id="nome7083" style="display: none;">CN Compras</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7083" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7083">7083</span> - <span id="nomeCentralizadora7083">CECPA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7083">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7083">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7083">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7083">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7083">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7083">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7083">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7083"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>

                            <li id="">
                                <a data-toggle="modal" data-target="#modal5020"><h3 class="level-3 rectangle" id="botao5020"><span id="sigla5020">SULOG</span><br><span id="nome5020" style="display: none;">SN Logística</span></h3></a>

                                <!-- MODAL SULOG-->
                                <div class="modal fade bd-example-modal-xl" id="modal5020" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="super5020">5020</span> - <span id="siglaSuper5020">SULOG</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5020">Esta unidade não possui dados de indicadores.</p>
                                                <div class="card-deck">
                                                
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="prodUnidade5020">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="desUnidade5020">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="fteUnidade5020">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="lapUnidade5020">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                        </div>
                                                    </div>
                                                    <div class="card"  style="display: none;" id="corUnidade5020">
                                                        <div class="card-body align-middle">
                                                            <h4><span id="resultado5020"></span></h4>
                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5304"><h4 class="level-4 rectangle" id="botao5304"><span id="sigla5304">GESES</span><br><span id="nome5304" style="display: none;">GN Serviços e Suprimentos</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5304" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5304">5304</span> - <span id="siglaGerencia5304">GESES</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5304">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5304">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5304">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5304">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5304">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5304">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5304"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7097"><h5 class="level-5 rectangle" id="botao7097"><span id="sigla7097">CELOG</span><br><span id="nome7097" style="display: none;">CN Logística</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7097" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7097">7097</span> - <span id="nomeCentralizadora7097">CELOG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7097">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7097">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7097">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7097">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7097">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7097">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7097">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7097"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7087"><h5 class="level-5 rectangle" id="botao7087"><span id="sigla7087">CESEA</span><br><span id="nome7087" style="display: none;">CN Serviços de Apoio</span></h5></a>

                                                
                                                <div class="modal fade bd-example-modal-xl" id="modal7087" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7087">7087</span> - <span id="nomeCentralizadora7087">CESEA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7087">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7087">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7087">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7087">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7087">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7087">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7087">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7087"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5531"><h4 class="level-4 rectangle" id="botao5531"><span id="sigla5531">GEINF</span><br><span id="nome5531" style="display: none;">GN Infraestrutura</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5531" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5531">5531</span> - <span id="siglaGerencia5531">GEINF</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5531">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5531">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5531">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5531">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5531">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  style="display: none;" id="corUnidade5531">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5531"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7074"><h5 class="level-5 rectangle" id="botao7074"><span id="sigla7074">CEOGI</span><br><span id="nome7074" style="display: none;">CN Gestão de Imóveis</span></h5></a>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modal7074" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7074">7074</span> - <span id="nomeCentralizadora7074">CEOGI</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7074">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7074">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7074">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7074">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7074">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7074">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7074">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7074"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7072"><h5 class="level-5 rectangle" id="botao7072"><span id="sigla7072">CEINF</span><br><span id="nome7072" style="display: none;">CN Infraestrutura</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7072" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7072">7072</span> - <span id="nomeCentralizadora7072">CEINF</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7072">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7072">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7072">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7072">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7072">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7072">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7072">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7072"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li id="">
                                <a data-toggle="modal"  data-target="#modal5397"><h3 class="level-3 rectangle" id="botao5397"><span id="sigla5397">SUSEG</span><br><span id="nome5397" style="display: none;">SN Segurança</span></h3></a>

                                <!-- MODAL SUSEG-->
                                <div class="modal fade bd-example-modal-xl" id="modal5397" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="super5397">5397</span> - <span id="siglaSuper5397">SUSEG</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: #5f758f" id="unidadeSemNenhumDado5397">Esta unidade não possui dados de indicadores.</p>
                                                <div class="card-deck">
                                                
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="prodUnidade5397">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="desUnidade5397">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="fteUnidade5397">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body" style="display: none;" id="lapUnidade5397">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                        </div>
                                                    </div>
                                                    <div class="card"  style="display: none;" id="corUnidade5397">
                                                        <div class="card-body align-middle">
                                                            <h4><span id="resultado5397"></span></h4>
                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5390" ><h4 class="level-4 rectangle" id="botao5390"><span id="sigla5390">GEIDE</span><br><span id="nome5390" style="display: none;">GN Detecção e Reação à Fraude</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5390" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5390">5390</span> - <span id="siglaGerencia5390">GEIDE</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5390">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5390">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5390">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5390">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5390">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" style="display: none;" id="corUnidade5390">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5390"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7431"><h5 class="level-5 rectangle" id="botao7431"><span id="sigla7431">CESEG</span><br><span id="nome7431" style="display: none;">CN Segurança</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7431" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7431">7431</span> - <span id="nomeCentralizadora7431">CESEG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7431">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7431">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7431">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7431">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7431">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7431">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7431">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7431"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7754"><h5 class="level-5 rectangle" id="botao7754"><span id="sigla7754">CECAC</span><br><span id="nome7754" style="display: none;">CN Segurança em Cartão de Crédito</span></h5></a>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modal7754" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7754">7754</span> - <span id="nomeCentralizadora7754">CECAC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7754">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7754">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7754">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7754">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7754">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7754">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7754">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7754"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5554"><h4 class="level-4 rectangle" id="botao5554"><span id="sigla5554">GEIPF</span><br><span id="nome5554" style="display: none;">GN Prevenção à Fraude</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5554" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5554">5554</span> - <span id="siglaGerencia5554">GEIPF</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5554">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5554">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5554">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5554">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5554">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" style="display: none;" id="corUnidade5554">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5554"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <a data-toggle="modal" data-target="#modal7932"><h5 class="level-5 rectangle" id="botao7932"><span id="sigla7932">CEFRA</span><br><span id="nome7932" style="display: none;">CN Segurança e Fraude</span></h5></a>

                                                <div class="modal fade bd-example-modal-xl" id="modal7932" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7932">7932</span> - <span id="nomeCentralizadora7932">CEFRA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7932">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7932">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7932">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7932">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7932">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7932">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7932">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7932"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li id="">
                                        <a data-toggle="modal" data-target="#modal5533"><h4 class="level-4 rectangle" id="botao5533"><span id="sigla5533">GESEP</span><br><span id="nome5533" style="display: none;">GN Segurança Empresarial</span></h4></a>

                                        <div class="modal fade bd-example-modal-xl" id="modal5533" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel"> <span id="gerencia5533">5533</span> - <span id="siglaGerencia5533">GESEP</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #5f758f" id="unidadeSemNenhumDado5533">Esta unidade não possui dados de indicadores.</p>
                                                        <div class="card-deck">
                                                        
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="prodUnidade5533">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="desUnidade5533">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="fteUnidade5533">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="display: none;" id="lapUnidade5533">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" style="display: none;" id="corUnidade5533">
                                                                <div class="card-body align-middle">
                                                                    <h4><span id="resultado5533"></span></h4>
                                                                    <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ol class="level-5-wrapper">
                                            <li id="cisep">
                                                <a data-toggle="modal" ><h5 class="level-5 rectangle">CISEP<span style="display: none;">CN Segurança Empresarial</span></h5></a>

                                                <div class="list-group" id="listaCisep" style="display: none;">
                                                    
                                                    <a data-toggle="modal" data-target="#modal7635"><h6 class="list-group-item list-group-item-action" id="botao7635" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7635">CISEP / RE</span><br><span id="nome7635" style="display: none;">CN Segurança Empresarial</span></h6></a>
                                                
                                                    <a data-toggle="modal" data-target="#modal7637"><h6 class="list-group-item list-group-item-action" id="7637" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><span id="sigla7637">CISEP / SP</span><br><span id="nome7637" style="display: none;">CN Segurança Empresarial</span></h6></a>
                                                    
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7635" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7635">7635</span> - <span id="nomeCentralizadora7635">CISEP</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7635">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7635">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7635">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7635">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7635">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7635">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7635">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7635"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modal7637" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#5f758f; color:white;">
                                                                <h4 class="modal-title" id="exampleModalLabel"> <span id="centralizadora7637">7637</span> - <span id="nomeCentralizadora7637">CISEP</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card-title callout callout-info">
                                                                        <div class="d-flex justify-content-between">
                                                                            <form action="/produtividade-vilop/relatorio-geral/7637">
                                                                                <button type="submit" class="btn" style="background-color: #54bbab; color: white"><i class="fas fa-chart-bar"> </i>&nbsp&nbspIndicadores da Unidade</button>
                                                                            </form>&nbsp&nbsp
                                                                            <span class="text-right text-muted mt-2" style="font-size:12px;">1 Uplop = 28 minutos, equivalente a 1 unidade de processo relevante, volumoso da VILOP.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p style="color: #5f758f" id="unidadeSemNenhumDado7637">Esta unidade não possui dados de indicadores.</p>
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="prodUnidade7637">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="desUnidade7637">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="fteUnidade7637">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body" style="display: none;" id="lapUnidade7637">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" style="display: none;" id="corUnidade7637">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado7637"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                </ol>   
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/produtividade/indicadores-vilop.js') }}"></script>
@endsection