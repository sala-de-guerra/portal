<?php

namespace App\Http\Controllers\BensMoveis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BensMoveisController extends Controller
{
    public function index(){
        
        return view('portal.bens-moveis.index')->with('lista_itens');
        

    }

    public function exportaTabela(Request $request){

        
        // dd(request()->all());

        try{

            $txt = trim(str_replace('"','', $request->txt));

            $remover =['</span>', '"'];
            $string = str_replace($remover, '', $txt);   

            $lista = explode(" n ",$string);
            
            
            $lista_itens_inicial =[];
            foreach($lista as $item){
                array_push($lista_itens_inicial,explode(" - ", $item, 2));
            }

            $total_itens = sizeof($lista_itens_inicial);

            $lista_itens_inicial = array_slice($lista_itens_inicial, 1, $total_itens);

            $lista_itens = [];
            foreach ($lista_itens_inicial as $item){

                array_push($lista_itens, [
                    'quantidade' => $item[0],
                    'nome' => $item[1]
                    ]);    
            }

            // dd(request()->all());
            
            return view('portal.bens-moveis.index', compact('lista_itens'));

        }
        catch(\Exception $e){
            
            // return view('');
                     
            dd($e);
        }
    }

}
