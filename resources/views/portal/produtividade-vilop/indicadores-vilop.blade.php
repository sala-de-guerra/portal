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
</style>
@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')

@section('saudacao')
<div class="card-header">
    <h3 class="card-title callout callout-info mt-1">
        Indicadores VILOP
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
<div class="row"> <!-- /.card-unidades -->
    <div class="col-md-12">
        <div class="card">
            <div class="container">
                <h1 class="level-1 rectangle" data-toggle="modal" data-target="#modalVilop"><a id="sigla5807">VILOP<span id="nome5807" style="display: none;"><br/>VP Logística e Operações</span></a></h1>

                <!--Modal VILOP
                <div class="modal fade bd-example-modal-xl" id="modalVilop" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#005ca9; color:white;">
                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>VILOP</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="prodVilop"><strong></strong></span><sup style="font-size: 20px">%</sup></h2>
                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                        </div>
                                    </div>  
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                

                <ol class="level-2-wrapper">
                    <li class="subVilop" id="deopc">
                        <h2 class="level-2 rectangle" data-toggle="modal" data-target="#modalDeopc"><a id="sigla5016" >DEOPC<span id="nome5016" style="display: none;"><br/>DE Operações e Contratos</span></a></h2>
                        
                            <!--Modal DEOPC

                        <div class="modal fade bd-example-modal-xl" id="modalDeopc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#f39200; color:white;">
                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>DEOPC</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                </div>
                                            </div>  
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <ol class="level-3A-wrapper">
                            <li class="subDeopc" id="sucot">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSucot"><a id="sigla5061">SUCOT<span id="nome5061" style="display: none;"><br/>SN Contratos</span></a></h3>

                                <!--Modal SUCOT

                                <div class="modal fade bd-example-modal-xl" id="modalSucot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>SUCOT</b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                        </div>
                                                    </div>  
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <ol class="level-4-wrapper">
                                    <li class="subSucot" id="Gefop">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGefop"><a id="sigla5532">GEFOP<span id="nome5532" style="display: none;"><br/>GN Gestão Formal Contratos e Pagamentos</span></a></h4>
                                        
                                        <!-- Modal GEFOP
                                        <div class="modal fade bd-example-modal-xl" id="modalGefop" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEFOP</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li class="coluna">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCefor"><a id="sigla5625">CEFOR<span id="nome5625" style="display: none;"><br/>CN Gestão Formal de Contratos</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCefor" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEFOR</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5625"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5625"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas5625"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5625"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5625"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="coluna">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCepag"><a id="sigla5568">CEPAG<span id="nome5568" style="display: none;"><br/>CN Pagamentos de Contratos</span></a>

                                                <div class="modal fade bd-example-modal-xl" id="modalCepag" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEPAG</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5568"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5568"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas5568"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5568"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5568"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecot"><a id="sigla5307">GECOT<span id="nome5307" style="display: none;"><br/>GN Contratos</span></a></h4>
                                        
                                        <!-- Modal GECOT
                                        <div class="modal fade bd-example-modal-xl" id="modalGecot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GECOT</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="Cecot">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecot"><a id="sigla5688">CECOT<span id="nome5688" style="display: none;"><br/>CN Contratos</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecot" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOT</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade5688"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho5688"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas5688"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada5688"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap5688"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSuban"><a id="sigla5032">SUBAN<span id="nome5032" style="display: none;"><br/>SN Operações Bancárias</span></a></h3>

                                <!-- Modal SUBAN
                                <div class="modal fade bd-example-modal-xl" id="modalSuban" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>SUBAN</b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                        </div>
                                                    </div>  
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                
                                <ol class="level-4B-wrapper">
                                    <li class="subSuban" id="geban">
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeban" id="sigla5402"><a id="sigla5402">GEBAN<span id="nome5402" style="display: none;"><br/>GN Processos Bancários</span></a></h4>

                                        <!-- Modal GEBAN
                                        <div class="modal fade bd-example-modal-xl" id="modalGeban" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEBAN</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        
                                        <ol class="level-5-wrapper">
                                            <li class="subGeban">
                                                <h5 class="level-5 rectangle"  data-toggle="modal" data-target="#modalCecom"><a id="sigla7822">CECOM<span id="nome7822" style="display: none;"><br/>CN Compensação Cheque e Outros Papéis</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecom" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOM</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7822"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7822"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7822"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7822"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7822"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGeban">
                                                <h5 class="level-5 rectangle"  data-toggle="modal" data-target="#modalCedip"><a id="sigla7009">CEDIP<span id="nome7009" style="display: none;"><br/>CN Dados e Inteligência em Op. Bancárias</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCedip" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEDIP</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7009"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7009"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7009"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7009"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7009"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeope" ><a id="sigla5401">GEOPE<span id="nome5401"style="display: none;"><br/>GN Operações Bancárias</span></a></h4>

                                        <!-- Modal GEOPE
                                        <div class="modal fade bd-example-modal-xl" id="modalGeope" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEOPE</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li class="subGeope">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecov"><a id="sigla7330">CECOV<span id="nome7330" style="display: none;"><br/>CN Convênios</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecov" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOV</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7330"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7330"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7330"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7330"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7330"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            <li class="subGeope">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCepoc"><a id="sigla7008">CEPOC<span id="nome7008" style="display: none;"><br/>CN Operações de Portabilidade</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCepoc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEPOC</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7008"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7008"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7008"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7008"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7008"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            <li class="subGeope" id="ceope">
                                                <h5 class="level-5 rectangle"><a id="">CEOPE<span style="display: none;"><br/>CN Operações Bancárias</span></a></h5>

                                                <div class="list-group" id="listaCeope" style="display: none;">
                                                    
                                                    <h6 data-toggle="modal" data-target="#modalCeopeBU" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7829">CEOPE / BU<span id="nome7829" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeBE" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7740">CEOPE / BE<span id="nome7740" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeBH" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7864">CEOPE / BH<span id="nome7864" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeCT" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7010">CEOPE / CT<span id="nome7010" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeFO" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7011">CEOPE / FO<span id="nome7011" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                            
                                                    <h6 data-toggle="modal" data-target="#modalCeopePO" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7790">CEOPE / PO<span id="nome7790" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeRE" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7758">CEOPE / RE<span id="nome7758" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeRJ" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7838">CEOPE / RJ<span id="nome7838" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                
                                                    <h6 data-toggle="modal" data-target="#modalCeopeSP" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7844">CEOPE / SP<span id="nome7844" style="display: none;"><br/>CN Operações Bancárias</span></a></h6>
                                                    
                                                </div>
                                                
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCeopeBU" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / BU</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7829"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7829"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7829"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7829"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7829"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / BE</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7740"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7740"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7740"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7740"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7740"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / BH</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7764"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7764"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7764"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7764"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7764"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / CT</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7010"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7010"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7010"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7010"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7010"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / FO</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7011"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7011"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7011"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7011"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7011"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / PO</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7790"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7790"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7790"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7790"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7790"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / RE</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7758"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7758"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7758"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7758"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7758"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / RJ</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7838"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7838"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7838"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7838"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7838"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPE / SP</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7844"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7844"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7844"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7844"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7844"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGemob" ><a id="sigla5517">GEMOB<span id="nome5517" style="display: none;"><br/>GN Manutenção de Op. Bancárias</span></a></h4>

                                        <!-- Modal GEMOB
                                        <div class="modal fade bd-example-modal-xl" id="modalGemob" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEMOB</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li class="subGemob">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCemob"><a id="sigla7017">CEMOB<span id="nome7017" style="display: none;"><br/>CN Manutenção Op. Bancárias</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCemob" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEMOB</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7017"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7017"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7017"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7017"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7017"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGemob">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCemoc"><a id="sigla7014">CEMOC<span id="nome7014" style="display: none;"><br/>CN Manutenção Op. C. Consignado</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCemoc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEMOC</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7014"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7014"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7014"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7014"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7014"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGemob" id="cecoq">
                                                <h5 class="level-5 rectangle"><a>CECOQ<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h5>

                                                <div class="list-group" style="display: none;" id="listaCecoq">
                                                    
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_CP" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7823">CECOQ / CP<span id="nome7823" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>

                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_CG" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7772">CECOQ / CG<span id="nome7772" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_CT" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7804">CECOQ / CT<span id="nome7804" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_FO" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7723">CECOQ / FO<span id="nome7723" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_GO" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7743">CECOQ / GO<span id="nome7743" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_SA" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla">CECOQ / SA<span id="nome" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_SP" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7824">CECOQ / SP<span id="nome7824" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                    <h6 class="list-group-item  list-group-item-action" data-toggle="modal" data-target="#modalCecoq_VT" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7736">CECOQ / VT<span id="nome7736" style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h6>
                                                
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecoq_CP" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / CP</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7823"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7823"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7823"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7823"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7823"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / CG</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7772"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7772"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7772"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7772"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7772"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / CT</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7804"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7804"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7804"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7804"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7804"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / FO</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7723"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7723"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7723"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7723"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7723"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / GO</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7743"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7743"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7743"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7743"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7743"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / SA</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / SP</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7824"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7824"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7824"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7824"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7824"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECOQ / VT</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7736"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7736"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7736"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7736"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7736"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="subGemob">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCemab"><a id="sigla7253">CEMAB<span id="nome7253" style="display: none;"><br/>CN Manutenção p/ Alienação de Bens</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCemab" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEMAB</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7253"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7253"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7253"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7253"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7253"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeotn" ><a id="sigla5510">GEOTN<span id="nome5510" style="display: none;"><br/>GN Operações de Tesouraria e Numerário</span></a></h4>

                                        <!-- Modal GEOTN
                                        <div class="modal fade bd-example-modal-xl" id="modalGeotn" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEOTN</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li class="subGeotn">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCelcc"><a id="sigla7012">CELCC<span id="nome7012" style="display: none;"><br/>CN Liquidação, Custódia e Câmbio</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCelcc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CELCC</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7012"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7012"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7012"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7012"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7012"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGeotn">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeopn"><a id="sigla7854">CEOPN<span id="nome7854" style="display: none;"><br/>CN Operações de Numerário</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeopn" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOPN</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7854"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7854"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7854"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7854"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7854"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGesec" ><a id="sigla5516">GESEC<span id="nome5516" style="display: none;"><br/>GN Serviços de Op. Bancárias e Carteiras</span></a></h4>

                                        <!-- Modal GESEC
                                        <div class="modal fade bd-example-modal-xl" id="modalGesec" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GESEC</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCesec"><a id="sigla7016">CESEC<span id="nome7016" style="display: none;"><br/>CN Serviços de Op. Bancárias e Carteiras</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCesec" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CESEC</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7016"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7016"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7016"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7016"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7016"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCesig"><a id="sigla7786">CESIG<span id="nome7786" style="display: none;"><br>CN Sigilo Bancário</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCesig" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CESIG</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7786"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7786"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7786"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7786"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7786"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCepat"><a id="sigla7077">CEPAT<span id="nome7077" style="display: none;"><br>CN Patrimônio e Bens de Terceiros</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCepat" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEPAT</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7077"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7077"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7077"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7077"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7077"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeven"><a id="sigla7251">CEVEN<span id="nome7251" style="display: none;"><br>CN Vendas de Bens</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeven" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEVEN</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7251"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7251"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7251"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7251"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7251"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCedic"><a id="sigla7015">CEDIC<span id="nome7015" style="display: none;"><br>CN Recuperação de Direitos Creditórios</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCedic" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEDIC</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7015"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7015"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7015"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7015"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7015"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                        <h2 class="level-2 rectangle" data-toggle="modal" data-target="#modalDelos"><a id="sigla5119">DELOS<span id="nome5119" style="display: none;"><br>DE Logística e Segurança</span></a></h2>

                        <!--Modal DELOS
                        <div class="modal fade bd-example-modal-xl" id="modalDelos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#f39200; color:white;">
                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>DELOS</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                </div>
                                            </div>  
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <ol class="level-3B-wrapper">
                            <li id="">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSucpa"><a id="sigla5173">SUCPA<span id="nome5173" style="display: none;"><br>SN Compras</span></a></h3>

                                <!-- Modal SUCPA
                                <div class="modal fade bd-example-modal-xl" id="modalSucpa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>SUCPA</b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                        </div>
                                                    </div>  
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecpe" ><a id="sigla5334">GECPE<span id="nome5334" style="display: none;"><br>GN Compras de Gestão de Pessoas</span></a></h4>

                                        <!-- MODAL GECPE
                                        <div class="modal fade bd-example-modal-xl" id="modalGecpe" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GECPE</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecpe"><a id="sigla7088">CECPE<span id="nome7088" style="display: none;"><br>CN Compras de Gestão de Pessoas</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecpe" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECPE</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7088"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7088"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7088"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7088"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7088"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecma" ><a id="sigla7079">GECMA<span id="nome7079" style="display: none;"><br>GN Compras de Marketing</span></a></h4>

                                        <!-- MODAL GECMA
                                        <div class="modal fade bd-example-modal-xl" id="modalGecma" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GECMA</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecma"><a id="sigla7081">CECMA<span id="nome7081" style="display: none;"><br>CN Compras de Marketing</span></a></h5>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCecma" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECMA</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7081"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7081"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7081"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7081"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7081"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecpa" ><a id="sigla5427">GECPA<span id="nome5427" style="display: none;"><br>GN Compras</span></a></h4>

                                        <!-- modal GECPA
                                        <div class="modal fade bd-example-modal-xl" id="modalGecpa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GECPA</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecpa"><a id="sigla7083">CECPA<span id="nome7083" style="display: none;"><br>CN Compras</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCecpa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECPA</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7083"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7083"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7083"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7083"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7083"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSulog"><a id="sigla5020">SULOG<span id="nome5020" style="display: none;"><br>SN Logística</span></a></h3>

                                <!-- MODAL SULOG
                                <div class="modal fade bd-example-modal-xl" id="modalSulog" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>SULOG</b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                        </div>
                                                    </div>  
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeses" ><a id="sigla5304">GESES<span id="nome5304" style="display: none;"><br>GN Serviços e Suprimentos</span></a></h4>

                                        <!-- MODAL GESES
                                        <div class="modal fade bd-example-modal-xl" id="modalGeses" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GESES</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCelog"><a id="sigla7097">CELOG<span id="nome7097" style="display: none;"><br>CN Logística</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCelog" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CELOG</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7097"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7097"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7097"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7097"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7097"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCesea"><a id="sigla7087">CESEA<span id="nome7087" style="display: none;"><br>CN Serviços de Apoio</span></a></h5>

                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCesea" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CESEA</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7087"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7087"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7087"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7087"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7087"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeinf" ><a id="sigla5531">GEINF<span id="nome5531" style="display: none;"><br>GN Infraestrutura</span></a></h4>

                                        <!-- MODAL GEINF
                                        <div class="modal fade bd-example-modal-xl" id="modalGeinf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEINF</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeogi"><a id="sigla7074">CEOGI<span id="nome7074" style="display: none;"><br>CN Gestão de Imóveis</span></a></h5>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCeogi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEOGI</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7074"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7074"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7074"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7074"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7074"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCeinf"><a id="sigla7072">CEINF<span id="nome7072" style="display: none;"><br>CN Infraestrutura</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeinf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEINF</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7072"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7072"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7072"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7072"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7072"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSuseg"><a id="sigla5397">SUSEG<span id="nome5397" style="display: none;"><br>SN Segurança</span></a></h3>

                                <!-- MODAL SUSEG
                                <div class="modal fade bd-example-modal-xl" id="modalSuseg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#54bbab; color:white;">
                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>SUSEG</b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-deck">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                        </div>
                                                    </div>  
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeide" ><a id="sigla5390">GEIDE<span id="nome5390" style="display: none;"><br>GN Detecção e Reação à Fraude</span></a></h4>

                                        <!-- MODAL GEIDE
                                        <div class="modal fade bd-example-modal-xl" id="modalGeide" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEIDE</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"  data-toggle="modal" data-target="#modalCeseg"><a id="sigla7431">CESEG<span id="nome7431" style="display: none;"><br>CN Segurança</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCeseg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CESEG</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7431"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7431"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7431"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7431"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7431"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCecac"><a id="sigla7754">CECAC<span id="nome7754" style="display: none;"><br>CN Segurança em Cartão de Crédito</span></a></h5>
                                                
                                                <div class="modal fade bd-example-modal-xl" id="modalCecac" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CECAC</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7754"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7754"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7754"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7754"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7754"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeipf" ><a id="sigla5554">GEIPF<span id="nome5554" style="display: none;"><br>GN Prevenção à Fraude</span></a></h4>

                                        <!-- MODAL GEIPF
                                        <div class="modal fade bd-example-modal-xl" id="modalGeipf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GEIPF</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle" data-toggle="modal" data-target="#modalCefra"><a id="sigla7932">CEFRA<span id="nome7932" style="display: none;"><br>CN Segurança e Fraude</span></a></h5>

                                                <div class="modal fade bd-example-modal-xl" id="modalCefra" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CEFRA</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7932"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7932"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7932"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7932"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7932"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGesep" ><a id="sigla5533">GESEP<span id="nome5533" style="display: none;"><br>GN Segurança Empresarial</span></a></h4>

                                        <!-- MODAL GESEP
                                        <div class="modal fade bd-example-modal-xl" id="modalGesep" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#00b5e5; color:white;">
                                                        <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>GESEP</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-deck">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>116</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>100</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                </div>
                                                            </div>  
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>111</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>71</strong><sup style="font-size: 20px">%</sup></h2>
                                                                    <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h2 id="" style="color: #005ca9; text-align:left;"><strong>171</strong></h2>
                                                                    <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <ol class="level-5-wrapper">
                                            <li id="cisep">
                                                <h5 class="level-5 rectangle" ><a>CISEP<span style="display: none;"><br>CN Segurança Empresarial</span></a></h5>

                                                <div class="list-group" id="listaCisep" style="display: none;">
                                                    
                                                    <h6 class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalCisepRE" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7635">CISEP / RE<span id="nome7635" style="display: none;"><br/>CN Segurança Empresarial</span></a></h6>
                                                
                                                    <h6 class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalCisepSP" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;"><a id="sigla7637">CISEP / SP<span id="nome7637" style="display: none;"><br/>CN Segurança Empresarial</span></a></h6>
                                                    
                                                </div>

                                                <div class="modal fade bd-example-modal-xl" id="modalCisepRE" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color:#d0e0e3; color:#48586c;">
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CISEP / RE</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7635"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7635"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7635"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7635"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7635"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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
                                                                <h4 class="modal-title" id="exampleModalLabel">Indicadores <b>CISEP / SP</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-deck">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="produtividade7637"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Produtividade</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="desempenho7637"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Desempenho</h5>      
                                                                        </div>
                                                                    </div>  
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="pessoas7637"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">Pessoas</h5>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="fteApurada7637"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">FTE Apurada</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h2 id="" style="color: #005ca9; text-align:left;"><span id="lap7637"></span></h2>
                                                                            <h5 style="text-align:right; color: #48586c">LAP Unidade</h5>    
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