<style>
 :root {
  --level-1: #005ca9;
  --level-2: #f39200;
  --level-3: #54bbab;
  --level-4: #00b5e5;
  --level-5: #5f758f;
  --level-6: #5f758f;
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
  color: white;
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
        Indicadores: VILOP
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
<div class="row"> 
    <div class="col-md-12">
        <div class="card">
            <div class="container">
                <h1 class="level-1 rectangle" data-toggle="modal" data-target="#modalVilop"><a><span id="sigla5807">VILOP</span><br><span id="nome5807" style="display: none;">VP Logística e Operações</span></a></h1>

                <!--Modal VILOP-->
                <div class="modal fade bd-example-modal-xl" id="modalVilop" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#005ca9; color:white;">
                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="vice5807">5807</span> - <span id="siglaVice5807">VILOP</span></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                        </div>
                                    </div>  
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5807"></span></h2>
                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                        </div>
                                    </div>
                                    <div class="card"  id="corUnidade5807">                                                       
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
                        <h2 class="level-2 rectangle" data-toggle="modal" data-target="#modalDeopc"><a><span id="sigla5016" >DEOPC</span><br><span id="nome5016" style="display: none;">DE Operações e Contratos</span></a></h2>
                        
                            <!--Modal DEOPC-->

                        <div class="modal fade bd-example-modal-xl" id="modalDeopc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#f39200; color:white;">
                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="diretoria5016">5016</span> - <span id="siglaDiretoria5016">DEOPC</span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                </div>
                                            </div>  
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5016"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                </div>
                                            </div>
                                            <div class="card"  id="corUnidade5016">                                                          
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSucot"><a><span id="sigla5061">SUCOT</span><br><span id="nome5061" style="display: none;">SN Contratos</span></a></h3>

                                <!--Modal SUCOT-->

                                <div class="modal fade bd-example-modal-xl" id="modalSucot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="super5061">5061</span> - <span id="siglaSuper5061">SUCOT</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5061"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card"  id="corUnidade5061">                                                          
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGefop"><a><span id="sigla5532">GEFOP</span><br><span id="nome5532" style="display: none;">GN Gestão Formal Contratos e Pagamentos</span></a></h4>
                                        
                                        <!-- Modal GEFOP-->
                                        <div class="modal fade bd-example-modal-xl" id="modalGefop" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5532">5532</span> - <span id="siglaGerencia5532">GEFOP</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5532"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5532">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCefor"><a><span id="sigla5625">CEFOR</span><br><span id="nome5625" style="display: none;">CN Gestão Formal de Contratos</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCefor" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora5625">5625</span> - <span id="nomeCentralizadora5625">CEFOR</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5625"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade5625">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCepag"><a><span id="sigla5568">CEPAG</span><br><span id="nome5568" style="display: none;">CN Pagamentos de Contratos</span></a>

                                                <div class="modal fade bd-example-modal-xl" id="modalCepag" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora5568">5568</span> - <span id="nomeCentralizadora5568">CEPAG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5568"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade5568">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecot"><a><span id="sigla5307">GECOT</span><br><span id="nome5307" style="display: none;">GN Contratos</span></a></h4>
                                        
                                        
                                        <div class="modal fade bd-example-modal-xl" id="modalGecot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5307">5307</span> - <span id="siglaGerencia5307">GECOT</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5307"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5307">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecot"><a><span id="sigla5688">CECOT</span><br><span id="nome5688" style="display: none;">CN Contratos</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora5688">5688</span> - <span id="nomeCentralizadora5688">CECOT</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4>
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5688"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade5688">
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSuban"><a><span id="sigla5032">SUBAN</span><br><span id="nome5032" style="display: none;">SN Operações Bancárias</span></a></h3>

                                <!-- Modal SUBAN-->
                                <div class="modal fade bd-example-modal-xl" id="modalSuban" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="super5032">5032</span> - <span id="siglaSuper5032">SUBAN</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5032"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card"  id="corUnidade5032">                                                          
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeban" id="sigla5402"><a><span id="sigla5402">GEBAN</span><br><span id="nome5402" style="display: none;">GN Processos Bancários</span></a></h4>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modalGeban" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5402">5402</span> - <span id="siglaGerencia5402">GEBAN</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5402"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4>
                                                                </div>
                                                            </div>
                                                            <div class="card" id="corUnidade5402">
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
                                                <h5 class="level-5 rectangle"  data-toggle="modal" data-target="#modalCecom"><a><span id="sigla7822">CECOM</span><br><span id="nome7822" style="display: none;">CN Compensação Cheque e Outros Papéis</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecom" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7822">7822</span> - <span id="nomeCentralizadora7822">CECOM</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7822"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7822">
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
                                                <h5 class="level-5 rectangle"  data-toggle="modal" data-target="#modalCedip"><a><span id="sigla7009">CEDIP</span><br><span id="nome7009" style="display: none;">CN Dados e Inteligência em Op. Bancárias</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCedip" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7009">7009</span> - <span id="nomeCentralizadora7009">CEDIP</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7009"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7009">
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeope" ><a><span id="sigla5401">GEOPE</span><br><span id="nome5401"style="display: none;">GN Operações Bancárias</span></a></h4>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modalGeope" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5401">5401</span> - <span id="siglaGerencia5401">GEOPE</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5401"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5401">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecov"><a><span id="sigla7330">CECOV</span><br><span id="nome7330" style="display: none;">CN Convênios</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecov" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7330">7330</span> - <span id="nomeCentralizadora7330">CECOV</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7330"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7330">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCepoc"><a><span id="sigla7008">CEPOC</span><br><span id="nome7008" style="display: none;">CN Operações de Portabilidade</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCepoc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7008">7008</span> - <span id="nomeCentralizadora7008">CEPOC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7008"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7008">
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
                                                <h5 class="level-5 rectangle"><a><span id="">CEOPE</span><br><span style="display: none;">CN Operações Bancárias</span></a></h5>

                                                <div class="list-group" id="listaCeope" style="display: none;">
                                                    
                                                    <h6 data-toggle="modal" data-target="#modalCeopeBU" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7829">CEOPE / BU</span><br><span id="nome7829" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeBE" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7740">CEOPE / BE</span><br><span id="nome7740" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeBH" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7864">CEOPE / BH</span><br><span id="nome7864" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeCT" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7010">CEOPE / CT></span><br><span id="nome7010" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeFO" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7011">CEOPE / FO></span><br><span id="nome7011" style="display: none;">CN Operações Bancárias</span></a></h6>
                                            
                                                    <h6 data-toggle="modal" data-target="#modalCeopePO" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span  id="sigla7790">CEOPE / PO</span><br><span id="nome7790" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeRE" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span  id="sigla7758">CEOPE / RE</span><br><span id="nome7758" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeRJ" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span  id="sigla7838">CEOPE / RJ</span><br><span id="nome7838" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeSP" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span  id="sigla7844">CEOPE / SP</span><br><span id="nome7844" style="display: none;">CN Operações Bancárias</span></a></h6>
                                                    
                                                </div>
                                                
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeBU" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7829">7829</span> - <span id="nomeCentralizadora7829">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7829"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7829">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeBE" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7740">7740</span> - <span id="nomeCentralizadora7740">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7740"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7740">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeBH" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7764">7764</span> - <span id="nomeCentralizadora7764">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7764"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7764">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeCT" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7010">7010</span> - <span id="nomeCentralizadora7010">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7010"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7010">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeFO" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7011">7011</span> - <span id="nomeCentralizadora7011">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7011"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7011">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopePO" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7790">7790</span> - <span id="nomeCentralizadora7790">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7790"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7790">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeRE" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel"  >Indicadores: <span id="centralizadora7758">7758</span> - <span id="nomeCentralizadora7758">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>               
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7758"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7758">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeRJ" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7838">7838</span> - <span id="nomeCentralizadora7838">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7838"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7838">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeSP" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7844">7844</span> - <span id="nomeCentralizadora7844">CEOPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7844"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7844">
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGemob" ><a><span id="sigla5517">GEMOB</span><br><span id="nome5517" style="display: none;">GN Manutenção de Op. Bancárias</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGemob" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5517">5517</span> - <span id="siglaGerencia5517">GEMOB</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5517"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5517">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCemob"><a><span id="sigla7017">CEMOB</span><br><span id="nome7017" style="display: none;">CN Manutenção Op. Bancárias</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCemob" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7017">7017</span> - <span id="nomeCentralizadora7017">CEMOB</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7017"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7017">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCemoc"><a><span id="sigla7014">CEMOC</span><br><span id="nome7014" style="display: none;">CN Manutenção Op. C. Consignado</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCemoc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7014">7014</span> - <span id="nomeCentralizadora7014">CEMOC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7014"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7014">
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
                                                <h5 class="level-5 rectangle"><a>CECOQ<span style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h5>

                                                <div class="list-group" style="display: none;" id="listaCecoq">
                                                    
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_CP" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7823">CECOQ / CP</span><br><span id="nome7823" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>

                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_CG" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7772">CECOQ / CG</span><br><span id="nome7772" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_CT" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7804">CECOQ / CT</span><br><span id="nome7804" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_FO" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7723">CECOQ / FO</span><br><span id="nome7723" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_GO" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7743">CECOQ / GO</span><br><span id="nome7743" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_SA" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla">CECOQ / SA</span><br><span id="nome" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_SP" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7824">CECOQ / SP</span><br><span id="nome7824" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_VT" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7736">CECOQ / VT</span><br><span id="nome7736" style="display: none;">CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_CP" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7823">7823</span> - <span id="nomeCentralizadora7823">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7823"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7823">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_CG" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7772">7772</span> - <span id="nomeCentralizadora7772">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7772"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7772">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_CT" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7804">7804</span> - <span id="nomeCentralizadora7804">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7804"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7804">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_FO" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7723">7723</span> - <span id="nomeCentralizadora7723">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7723"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7723">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_GO" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7743">7743</span> - <span id="nomeCentralizadora7743">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7743"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7743">
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
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora"></span> - <span id="nomeCentralizadora">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade">
                                                                        <div class="card-body align-middle">
                                                                            <h4><span id="resultado"></span></h4>
                                                                            <p class="legenda" style="color: white;">Produtividade / Desempenho</p>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_SP" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7824">7824</span> - <span id="nomeCentralizadora7824">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7824"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7824">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_VT" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7736">7736</span> - <span id="nomeCentralizadora7736">CECOQ</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7736"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7736">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCemab"><a><span id="sigla7253">CEMAB</span><br><span id="nome7253" style="display: none;">CN Manutenção p/ Alienação de Bens</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCemab" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7253">7253</span> - <span id="nomeCentralizadora7253">CEMAB</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7253"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7253">
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeotn" ><a><span id="sigla5510">GEOTN</span><br><span id="nome5510" style="display: none;">GN Operações de Tesouraria e Numerário</span></a></h4>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modalGeotn" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5510">5510</span> - <span id="siglaGerencia5510">GEOTN</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5510"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" id="corUnidade5510">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCelcc"><a><span id="sigla7012">CELCC</span><br><span id="nome7012" style="display: none;">CN Liquidação, Custódia e Câmbio</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCelcc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7012">7012</span> - <span id="nomeCentralizadora7012">CELCC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7012"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7012">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeopn"><a><span id="sigla7854">CEOPN</span><br><span id="nome7854" style="display: none;">CN Operações de Numerário</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopn" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7854">7854</span> - <span id="nomeCentralizadora7854">CEOPN</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7854"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7854">
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGesec" ><a><span id="sigla5516">GESEC</span><br><span id="nome5516" style="display: none;">GN Serviços de Op. Bancárias e Carteiras</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGesec" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5516">5516</span> - <span id="siglaGerencia5516">GESEC</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5516"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5516">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCesec"><a><span id="sigla7016">CESEC</span><br><span id="nome7016" style="display: none;">CN Serviços de Op. Bancárias e Carteiras</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCesec" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7016">7016</span> - <span id="nomeCentralizadora7016">CESEC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7016"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7016">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCesig"><a><span id="sigla7786">CESIG</span><br><span id="nome7786" style="display: none;">CN Sigilo Bancário</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCesig" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7786">7786</span> - <span id="nomeCentralizadora7786">CESIG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7786"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7786">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCepat"><a><span id="sigla7077">CEPAT</span><br><span id="nome7077" style="display: none;">CN Patrimônio e Bens de Terceiros</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCepat" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7077">7077</span> - <span id="nomeCentralizadora7077">CEPAT</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7077"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7077">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeven"><a><span id="sigla7251">CEVEN</span><br><span id="nome7251" style="display: none;">CN Vendas de Bens</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeven" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7251">7251</span> - <span id="nomeCentralizadora7251">CEVEN</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7251"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7251">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCedic"><a><span id="sigla7015">CEDIC</span><br><span id="nome7015" style="display: none;">CN Recuperação de Direitos Creditórios</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCedic" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7015">7015</span> - <span id="nomeCentralizadora7015">CEDIC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7015"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7015">
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
                        <h2 class="level-2 rectangle" data-toggle="modal" data-target="#modalDelos"><a><span id="sigla5119">DELOS</span><br><span id="nome5119" style="display: none;">DE Logística e Segurança</span></a></h2>

                        <!--Modal DELOS-->
                        <div class="modal fade bd-example-modal-xl" id="modalDelos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#f39200; color:white;">
                                    <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="diretoria5119">5119</span> - <span id="siglaDiretoria5119">DELOS</span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                </div>
                                            </div>  
                                        
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5119"></span></h2>
                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                </div>
                                            </div>
                                            <div class="card" id="corUnidade5119">
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSucpa"><a><span id="sigla5173">SUCPA</span><br><span id="nome5173" style="display: none;">SN Compras</span></a></h3>

                                <!-- Modal SUCPA-->
                                <div class="modal fade bd-example-modal-xl" id="modalSucpa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="super5173">5173</span> - <span id="siglaSuper5173">SUCPA</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5173"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                        </div>
                                                    </div>
                                                    <div class="card"  id="corUnidade5173">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecpe" ><a><span id="sigla5334">GECPE</span><br><span id="nome5334" style="display: none;">GN Compras de Gestão de Pessoas</span></a></h4>

                                       
                                        <div class="modal fade bd-example-modal-xl" id="modalGecpe" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5334">5334</span> - <span id="siglaGerencia5334">GECPE</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5334"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5334">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecpe"><a><span id="sigla7088">CECPE</span><br><span id="nome7088" style="display: none;">CN Compras de Gestão de Pessoas</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecpe" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7088">7088</span> - <span id="nomeCentralizadora7088">CECPE</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7088"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7088">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecma" ><a><span id="sigla7079">GECMA</span><br><span id="nome7079" style="display: none;">GN Compras de Marketing</span></a></h4>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modalGecma" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia7079">7079</span> - <span id="siglaGerencia7079">GECMA</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7079"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade7079">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecma"><a><span id="sigla7081">CECMA</span><br><span id="nome7081" style="display: none;">CN Compras de Marketing</span></a></h5>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCecma" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7081">7081</span> - <span id="nomeCentralizadora7081">CECMA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7081"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7081">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecpa" ><a><span id="sigla5427">GECPA</span><br><span id="nome5427" style="display: none;">GN Compras</span></a></h4>

                                        
                                        <div class="modal fade bd-example-modal-xl" id="modalGecpa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5427">5427</span> - <span id="siglaGerencia5427">GECPA</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5427"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" id="corUnidade5427">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecpa"><a><span id="sigla7083">CECPA</span><br><span id="nome7083" style="display: none;">CN Compras</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecpa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7083">7083</span> - <span id="nomeCentralizadora7083">CECPA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7083"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7083">
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSulog"><a><span id="sigla5020">SULOG</span><br><span id="nome5020" style="display: none;">SN Logística</span></a></h3>

                                <!-- MODAL SULOG-->
                                <div class="modal fade bd-example-modal-xl" id="modalSulog" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="super5020">5020</span> - <span id="siglaSuper5020">SULOG</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5020"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                        </div>
                                                    </div>
                                                    <div class="card"  id="corUnidade5020">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeses" ><a><span id="sigla5304">GESES</span><br><span id="nome5304" style="display: none;">GN Serviços e Suprimentos</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGeses" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5304">5304</span> - <span id="siglaGerencia5304">GESES</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5304"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5304">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCelog"><a><span id="sigla7097">CELOG</span><br><span id="nome7097" style="display: none;">CN Logística</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCelog" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7097">7097</span> - <span id="nomeCentralizadora7097">CELOG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7097"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7097">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCesea"><a><span id="sigla7087">CESEA</span><br><span id="nome7087" style="display: none;">CN Serviços de Apoio</span></a></h5>

                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCesea" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7087">7087</span> - <span id="nomeCentralizadora7087">CESEA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7087"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7087">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeinf" ><a><span id="sigla5531">GEINF</span><br><span id="nome5531" style="display: none;">GN Infraestrutura</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGeinf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5531">5531</span> - <span id="siglaGerencia5531">GEINF</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5531"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card"  id="corUnidade5531">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeogi"><a><span id="sigla7074">CEOGI</span><br><span id="nome7074" style="display: none;">CN Gestão de Imóveis</span></a></h5>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCeogi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7074">7074</span> - <span id="nomeCentralizadora7074">CEOGI</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7074"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7074">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeinf"><a><span id="sigla7072">CEINF</span><br><span id="nome7072" style="display: none;">CN Infraestrutura</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeinf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7072">7072</span> - <span id="nomeCentralizadora7072">CEINF</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7072"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7072">
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSuseg"><a><span id="sigla5397">SUSEG</span><br><span id="nome5397" style="display: none;">SN Segurança</span></a></h3>

                                <!-- MODAL SUSEG-->
                                <div class="modal fade bd-example-modal-xl" id="modalSuseg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="super5397">5397</span> - <span id="siglaSuper5397">SUSEG</span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                        </div>
                                                    </div>  
                                                   
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5397"></span></h2>
                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                        </div>
                                                    </div>
                                                    <div class="card"  id="corUnidade5397">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeide" ><a><span id="sigla5390">GEIDE</span><br><span id="nome5390" style="display: none;">GN Detecção e Reação à Fraude</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGeide" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5390">5390</span> - <span id="siglaGerencia5390">GEIDE</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5390"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" id="corUnidade5390">
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
                                                <h5 class="level-5 rectangle"  data-toggle="modal" data-target="#modalCeseg"><a><span id="sigla7431">CESEG</span><br><span id="nome7431" style="display: none;">CN Segurança</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeseg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7431">7431</span> - <span id="nomeCentralizadora7431">CESEG</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7431"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7431">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecac"><a><span id="sigla7754">CECAC</span><br><span id="nome7754" style="display: none;">CN Segurança em Cartão de Crédito</span></a></h5>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCecac" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7754">7754</span> - <span id="nomeCentralizadora7754">CECAC</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7754"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7754">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeipf" ><a><span id="sigla5554">GEIPF</span><br><span id="nome5554" style="display: none;">GN Prevenção à Fraude</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGeipf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5554">5554</span> - <span id="siglaGerencia5554">GEIPF</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5554"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" id="corUnidade5554">
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
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCefra"><a><span id="sigla7932">CEFRA</span><br><span id="nome7932" style="display: none;">CN Segurança e Fraude</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCefra" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7932">7932</span> - <span id="nomeCentralizadora7932">CEFRA</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7932"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7932">
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGesep" ><a><span id="sigla5533">GESEP</span><br><span id="nome5533" style="display: none;">GN Segurança Empresarial</span></a></h4>

                                        <div class="modal fade bd-example-modal-xl" id="modalGesep" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="gerencia5533">5533</span> - <span id="siglaGerencia5533">GESEP</span></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                    <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                    <p class="legenda">Volume Realizado / Volume Total</p>
                                                                </div>
                                                            </div> 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="fte5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                    <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5533"></span></h2>
                                                                    <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                </div>
                                                            </div>
                                                            <div class="card" id="corUnidade5533">
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
                                                <h5 class="level-5 rectangle" ><a>CISEP<span style="display: none;">CN Segurança Empresarial</span></a></h5>

                                                <div class="list-group" id="listaCisep" style="display: none;">
                                                    
                                                    <h6 class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalCisepRE" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7635">CISEP / RE</span><br><span id="nome7635" style="display: none;">CN Segurança Empresarial</span></a></h6>
                                                
                                                    <h6 class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalCisepSP" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a><span id="sigla7637">CISEP / SP</span><br><span id="nome7637" style="display: none;">CN Segurança Empresarial</span></a></h6>
                                                    
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modalCisepRE" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7635">7635</span> - <span id="nomeCentralizadora7635">CISEP</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7635"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7635">
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

                                                <div class="modal fade bd-example-modal-xl" id="modalCisepSP" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores: <span id="centralizadora7637">7637</span> - <span id="nomeCentralizadora7637">CISEP</span></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Produtividade</h4>
                                                                            <p class="legenda">UPLop Produzida / UPLop Devida</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">Desempenho</h4> 
                                                                            <p class="legenda">Volume Realizado / Volume Total</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">FTE Apurada</h4>
                                                                            <p class="legenda">FTE Atv Mensuráveis / FTE Produtiva</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7637"></span></h2>
                                                                            <h4 style="text-align:right; color: #48586c">LAP Unidade</h4> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="card" id="corUnidade7637">
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