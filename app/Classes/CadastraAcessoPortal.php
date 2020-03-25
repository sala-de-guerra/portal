<?php

namespace App\Classes;

use App\Models\AcessaPortal;
use App\Models\GestaoEquipesEmpregados;

class CadastraAcessoPortal
{
    private $matricula;
    private $eventual;
    private $nivelAcesso;
    private $unidade;
    public $arraySr = [
        '2487', '2489', '2573', '2574', '2575', '2576', '2577', '2578', '2579', '2580', '2581', '2582', '2584', '2585', 
        '2586', '2587', '2588', '2589', '2591', '2592', '2593', '2594', '2595', '2596', '2597', '2598', '2601', '2602', 
        '2603', '2604', '2606', '2607', '2608', '2612', '2613', '2615', '2616', '2617', '2618', '3335', '3410', '3599',
        '3031', '5824', '2506', '2795', '3661', '3675', '3678', '3680', '3683', '3727', '4012', '4169', '4170', '4172', 
        '3332', '2619', '2621', '2622', '2623', '2624', '2625', '2626', '2627', '2628', '2629', '2634', '2635', '2636', 
        '2637', '2639', '2640', '2641', '2642', '2645', '2646', '2647', '2648', '2649', '2650', '2651', '2653', '2654',
        '2655', '2656', '2690', '2691', '2692', '2693', '2694', '3222', '3226', '3227'
    ];
    public $arrayAudir = [
        '7111', '7112', '7849', '7113', '7100', '7114', '7115', '7110', '7116', '7117', '7118', '7119', '7120'
    ];
    public $arrayMatriz = [
        '5530', // GEIPT
    ];
    public $arrayCodigoFuncaoGestao = [
        '2030' // COORDENADOR DE PROJETOS MATRIZ
        ,'2031' // COORDENADOR DE PROJETOS TI
        ,'2061' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 1
        ,'2062' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 2
        ,'2063' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 3
        ,'2064' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 4
        ,'2079' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 5 
        ,'2080' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 6
        ,'2111' // COORDENADOR DE TI - PORTE 1
        ,'2112' // COORDENADOR DE TI - PORTE 2
        ,'2113' // COORDENADOR DE TI - PORTE 3
        ,'2114' // COORDENADOR DE TI - PORTE 4
        ,'2115' // COORDENADOR DE TI - PORTE 5
        ,'2141' // GERENTE DE CENTRALIZADORA - PORTE 1
        ,'2142' // GERENTE DE CENTRALIZADORA - PORTE 2
        ,'2143' // GERENTE DE CENTRALIZADORA - PORTE 3
        ,'2145' // GERENTE DE CENTRALIZADORA - PORTE 4
        ,'2066' // GERENTE DE FILIAL - PORTE 1
        ,'2067' // GERENTE DE FILIAL - PORTE 2
        ,'2068' // GERENTE DE FILIAL - PORTE 3
        ,'2069' // GERENTE DE FILIAL - PORTE 4
        ,'2070' // GERENTE DE FILIAL - PORTE 5
        ,'2038' // GERENTE NACIONAL
        ,'2241' // GERENTE REGIONAL - PORTE 1
        ,'2242' // GERENTE REGIONAL - PORTE 2
        ,'2243' // GERENTE REGIONAL - PORTE 3
        ,'2244' // GERENTE REGIONAL - PORTE 4
        ,'2245' // GERENTE REGIONAL - PORTE 5
        ,'2246' // GERENTE REGIONAL - PORTE 6
        ,'2060' // SUPERVISOR - CENTRALIZADORA/FILIAL
        ,'2037' // GERENTE EXECUTIVO
    ];

    public $arrayCodigoUnidadesGilie = [
        '7257', // GILIE/SP
        '7244', // GILIE/BH
        '7243', // GILIE/BE
        '7109', // GILIE/BR
        '7247', // GILIE/CT
        '7248', // GILIE/FO
        '7249', // GILIE/GO
        '7251', // GILIE/PO
        '7254', // GILIE/RJ
        '7253', // GILIE/RE
        '7255', // GILIE/SA
        '7242'  // GILIE/BU
    ];

    public $arrayDesenvolvedores = [
        /* DESENVOLVIMENTO */
        'c142765',  // Carlos
        'c111710',  // Chuman
        'c098453',  // Rafael
        'c079436'   // Vladimir 
    ];

    /**
     * Get the value of matricula
     */ 
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set the value of matricula
     *
     * @return  self
     */ 
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * Get the value of eventual
     */ 
    public function getEventual()
    {
        return $this->eventual;
    }

    /**
     * Set the value of eventual
     *
     * @return  self
     */ 
    public function setEventual($matricula)
    {
        $eventualidade = GestaoEquipesEmpregados::find($matricula);
        $this->eventual = false;
        if (!is_null($eventualidade)) {
            if($eventualidade->eventualEquipe) {
                $this->eventual = true;
            } 
        } 
        return $this;
    }

    /**
     * Get the value of nivelAcesso
     */ 
    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }

    /**
     * Set the value of nivelAcesso
     *
     * @return  self
     */ 
    public function setNivelAcesso()
    {
        if(in_array($this->getUnidade(), $this->arraySr)) {
            $this->nivelAcesso = 'SR';
        } elseif (in_array($this->getUnidade(), $this->arrayAudir)) {
            $this->nivelAcesso = 'AUDITOR';
        } elseif (in_array($this->getUnidade(), $this->arrayMatriz)) {
            $this->nivelAcesso = 'MATRIZ';
        } elseif (in_array($this->getMatricula(), $this->arrayDesenvolvedores)) {
            $this->nivelAcesso = 'DESENVOLVEDOR';
        } elseif (in_array($this->getUnidade(), $this->arrayCodigoUnidadesGilie)) {
            if(in_array(session('codigoFuncao'), $this->arrayCodigoFuncaoGestao)) {
                $this->nivelAcesso = 'GESTOR';
            } elseif($this->getEventual()) {
                $this->nivelAcesso = 'EVENTUAL';
            } else {
                $this->nivelAcesso = env('NOME_NOSSA_UNIDADE');
            }
        } else {
            $this->nivelAcesso = 'AGENCIA';
        }
        return $this;
    }

    /**
     * Get the value of unidade
     */ 
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * Set the value of unidade
     *
     * @return  self
     */ 
    public function setUnidade($objEmpregado)
    {
        if ($objEmpregado->codigoLotacaoFisica === null) {
            $this->unidade = $objEmpregado->codigoLotacaoAdministrativa;
        } else {
            $this->unidade = $objEmpregado->codigoLotacaoFisica;
        }
        return $this;
    }

    public function __construct($objEmpregado)
    {
        $this->setMatricula($objEmpregado->matricula);
        $this->setEventual($objEmpregado->matricula);
        $this->setUnidade($objEmpregado);
        $this->setNivelAcesso();
        $this->atualizaPerfilAcessoEsteira();
    }

    public function __toString()
    {
        return json_encode(array(
            "matricula" => $this->getMatricula(),
            "nivelAcesso" => $this->getNivelAcesso(),
            "unidade" => $this->getUnidade(),
        ), JSON_UNESCAPED_SLASHES);
    }

    public function atualizaPerfilAcessoEsteira()
    {
        $cadastroAcesso = AcessaPortal::firstOrNew(['matricula' => $this->getMatricula()]);
        $cadastroAcesso->nivelAcesso = $this->getNivelAcesso();
        $cadastroAcesso->unidade = $this->getUnidade();
        $cadastroAcesso->touch();
        $cadastroAcesso->save(); 
    }
}