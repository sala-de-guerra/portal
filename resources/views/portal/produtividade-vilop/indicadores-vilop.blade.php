<style>
 :root {
  --level-1: #005ca9;
  --level-2: #f39200;
  --level-3: #54bbab;
  --level-4: #00b5e5;
  --level-5: #d0e0e3;
  --level-6: #e26650;
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
                <h1 class="level-1 rectangle" data-toggle="modal" data-target="#modalVilop"><a >VILOP<span style="display: none;"><br/>VP Logística e Operações</span></a></h1>

                <!--Modal VILOP-->
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

                

                <ol class="level-2-wrapper">
                    <li class="subVilop" id="deopc">
                        <h2 class="level-2 rectangle" data-toggle="modal" data-target="#modalDeopc"><a >DEOPC<span style="display: none;"><br/>DE Operações e Contratos</span></a></h2>
                        
                            <!--Modal DEOPC-->

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

                        <ol class="level-3A-wrapper">
                            <li class="subDeopc" id="sucot">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSucot"><a>SUCOT<span style="display: none;"><br/>SN Contratos</span></a></h3>

                                <!--Modal SUCOT-->

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

                                <ol class="level-4-wrapper">
                                    <li class="subSucot" id="Gefop">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGefop"><a>GEFOP<span style="display: none;"><br/>GN Gestão Formal Contratos e Pagamentos</span></a></h4>
                                        
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

                                        <ol class="level-5-wrapper">
                                            <li class="coluna">
                                                <h5 class="level-5 rectangle"><a href="#">CEFOR<span style="display: none;"><br/>CN Gestão Formal de Contratos</span></a></h5>
                                            </li>
                                            <li class="coluna">
                                                <h5 class="level-5 rectangle"><a href="#">CEPAG<span style="display: none;"><br/>CN Pagamentos de Contratos</span></a>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="subSucot" id="Gecot">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecot"><a >GECOT<span style="display: none;"><br/>GN Contratos</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="Cecot">
                                                <h5 class="level-5 rectangle"><a href="#">CECOT<span style="display: none;"><br/>CN Contratos</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li class="subDeopc" id="suban">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSuban"><a>SUBAN<span style="display: none;"><br/>SN Operações Bancárias</span></a></h3>

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
                                
                                <ol class="level-4B-wrapper">
                                    <li class="subSuban" id="geban">
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeban"><a>GEBAN<span style="display: none;"><br/>GN Processos Bancários</span></a></h4>

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
                                        
                                        <ol class="level-5-wrapper">
                                            <li class="subGeban">
                                                <h5 class="level-5 rectangle"><a href="#">CECOM<span style="display: none;"><br/>CN Compensação Cheque e Outros Papéis</span></a></h5>
                                            </li>
                                            <li class="subGeban">
                                                <h5 class="level-5 rectangle"><a href="#">CEDIP<span style="display: none;"><br/>CN Dados e Inteligência em Op. Bancárias</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="subSuban" id="geope">
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeope" ><a>GEOPE<span style="display: none;"><br/>GN Operações Bancárias</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li class="subGeope">
                                                <h5 class="level-5 rectangle"><a href="#">CECOV<span style="display: none;"><br/>CN Convênios</span></a></h5>
                                                
                                            </li>
                                            <li class="subGeope">
                                                <h5 class="level-5 rectangle"><a href="#">CEPOC<span style="display: none;"><br/>CN Operações de Portabilidade</span></a></h5>
                                                
                                            </li>
                                            <li class="subGeope" id="ceope">
                                                <h5 class="level-5 rectangle"><a href="#">CEOPE<span style="display: none;"><br/>CN Operações Bancárias</span></a></h5>

                                                <div class="list-group" id="listaCeope" style="display: none;">
                                                    
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / BU<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / BE<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / BH<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / CT<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / FO<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                            
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / PO<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / RE<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / RJ<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CEOPE / SP<span style="display: none;"><br/>CN Operações Bancárias</span></a>
                                                    
                                                </div>
                                                
                                            </li>
                                        </ol>
                                    </li>
                                    <li  class="subSuban" id="gemob">
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGemob" ><a>GEMOB<span style="display: none;"><br/>GN Manutenção de Op. Bancárias</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li class="subGemob">
                                                <h5 class="level-5 rectangle"><a href="#">CEMOB<span style="display: none;"><br/>CN Manutenção Op. Bancárias</span></a></h5>
                                            </li>
                                            <li class="subGemob">
                                                <h5 class="level-5 rectangle"><a href="#">CEMOC<span style="display: none;"><br/>CN Manutenção Op. C. Consignado</span></a></h5>
                                            </li>
                                            <li class="subGemob" id="cecoq">
                                                <h5 class="level-5 rectangle"><a href="#">CECOQ<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a></h5>

                                                <div class="list-group" style="display: none;" id="listaCecoq">
                                                    
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / CP<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / CG<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / CT<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / FO<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / GO<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / SA<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / SP<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                    <a href="#" class="list-group-item list-group-item-action" style="font-size: 12px; padding: 3px 3px; background-color:#EFF5F6; color:#48586c; text-align:center;">CECOT / VT<span style="display: none;"><br/>CN Conciliação e Qualificação de Transações</span></a>
                                                
                                                </div>
                                            </li>
                                            <li class="subGemob">
                                                <h5 class="level-5 rectangle"><a href="#">CEMAB<span style="display: none;"><br/>CN Manutenção p/ Alienação de Bens</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li  class="subSuban" id="geotn">
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGeotn" ><a>GEOTN<span style="display: none;"><br/>GN<br/>Operações<br>de<br/>Tesouraria<br>e<br/>Numerário</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li class="subGeotn">
                                                <h5 class="level-5 rectangle"><a href="#">CELCC<span style="display: none;"><br/>CN Liquidação, Custódia e Câmbio</span></a></h5>
                                            </li>
                                            <li class="subGeotn">
                                                <h5 class="level-5 rectangle"><a href="#">CEOPN<span style="display: none;"><br/>CN Operações de Numerário</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li  class="subSuban" id="gesec">
                                        <h4 class="level-4B rectangle" data-toggle="modal" data-target="#modalGesec" ><a>GESEC<span style="display: none;"><br/>GN<br/>Serviços<br>de Op. Bancárias<br>e Carteiras</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle"><a href="#">CESEC<span style="display: none;"><br/>CN Serviços de Op. Bancárias e Carteiras</span></a></h5>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle"><a href="#">CESIG<span style="display: none;"><br>CN Sigilo Bancário</span></a></h5>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle"><a href="#">CEPAT<span style="display: none;"><br>CN Patrimônio e Bens de Terceiros</span></a></h5>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle"><a href="#">CEVEN<span style="display: none;"><br>CN Vendas de Bens</span></a></h5>
                                            </li>
                                            <li class="subGesec">
                                                <h5 class="level-5 rectangle"><a href="#">CEDIC<span style="display: none;"><br>CN Recuperação de Direitos Creditórios</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li class="subVilop" id="delos">
                        <h2 class="level-2 rectangle" data-toggle="modal" data-target="#modalDelos"><a>DELOS<span style="display: none;"><br>DE Logística e Segurança</span></a></h2>

                        <!--Modal DELOS-->

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

                        <ol class="level-3B-wrapper">
                            <li id="">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSucpa"><a>SUCPA<span style="display: none;"><br>SN Compras</span></a></h3>

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

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecpe" ><a>GECPE<span style="display: none;"><br>GN Compras de Gestão de Pessoas</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CECPE<span style="display: none;"><br>CN Compras de Gestão de Pessoas</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecma" ><a>GECMA<span style="display: none;"><br>GN Compras de Marketing</span></a></h4>

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


                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CECMA<span style="display: none;"><br>CN Compras de Marketing</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGecpa" ><a>GECPA<span style="display: none;"><br>GN Compras</span></a></h4>

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
                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CEPCA<span style="display: none;"><br>CN Compras</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li id="">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSulog"><a>SULOG<span style="display: none;"><br>SN Logística</span></a></h3>

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

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeses" ><a>GESES<span style="display: none;"><br>GN Serviços e Suprimentos</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CELOG<span style="display: none;"><br>CN Logística</span></a></h5>
                                            </li>
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CESEA<span style="display: none;"><br>CN Serviços de Apoio</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeinf" ><a>GEINF<span style="display: none;"><br>GN Infraestrutura</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CEOGI<span style="display: none;"><br>CN Gestão de Imóveis</span></a></h5>
                                            </li>
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CEINF<span style="display: none;"><br>CN Infraestrutura</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li id="">
                                <h3 class="level-3 rectangle" data-toggle="modal" data-target="#modalSuseg"><a>SUSEG<span style="display: none;"><br>SN Segurança</span></a></h3>

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

                                <ol class="level-4-wrapper">
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeide" ><a>GEIDE<span style="display: none;"><br>GN Detecção e Reação à Fraude</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CESEG<span style="display: none;"><br>CN Segurança</span></a></h5>
                                            </li>
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CECAC<span style="display: none;"><br>CN Segurança em Cartão de Crédito</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGeipf" ><a>GEIPF<span style="display: none;"><br>GN Prevenção à Fraude</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CEFRA<span style="display: none;"><br>CN Segurança e Fraude</span></a></h5>
                                            </li>
                                        </ol>
                                    </li>
                                    <li id="">
                                        <h4 class="level-4 rectangle" data-toggle="modal" data-target="#modalGesep" ><a>GESEP<span style="display: none;"><br>GN Segurança Empresarial</span></a></h4>

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

                                        <ol class="level-5-wrapper">
                                            <li id="">
                                                <h5 class="level-5 rectangle"><a href="#">CISEP<span style="display: none;"><br>CN Segurança Empresarial</span></a></h5>
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