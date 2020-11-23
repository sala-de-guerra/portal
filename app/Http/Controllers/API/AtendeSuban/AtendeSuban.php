<?php


namespace App\Http\Controllers\API\AtendeSuban;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\HistoricoPortalGilie;
use App\Classes\DiasUteisClass;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Client\Response as Response2;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class AtendeSuban extends Controller
{

    public function index()
    {
        return view('portal.api.demonstracao-api');
    }

    public function capturarCategoriasAtendeCemob()
    {

        $url = 'http://10.123.8.177:3011/atende/integracao/listarCategorias';
        $response = $this->prepararCabecalhosAtende($url);
        return $response->json();
    }

    public function capturarCategoriasAtende()
    {
        // try{
        // $url = 'http://10.123.8.177:3011/atende/integracao/novaSolicitacao';
        // $response = $this->prepararCabecalhosAtende($url);
        // return $response->json();
        // }catch (\Throwable $th) {
        //    $erro = ["Erro" => $th->getMessage()];
        //    return $erro;
        // }

        $url = 'http://10.123.8.177:3011/atende/integracao/listarCategorias';
        $response = $this->prepararCabecalhosAtende($url);
        return $response->json();
    }

    public function listaAtende(): array
    {
        try{
        $url = "http://10.123.8.177:3011/atende/integracao/demandasPendentes/'2020-11-12'";
        $response = $this->prepararCabecalhosAtende($url);
        return $response->json();
        }catch (\Throwable $th) {
           dd($th->getMessage());
        }
    }

    private function prepararCabecalhosAtende(string $url): Response2
    {
        $token =
        $token = env('ATENDE_TOKEN');
        return Http::withToken($token)->withHeaders([
            'Accept' => 'application/json, text/plain, */*',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Language' => 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,es;q=0.6',
        ])->get($url);
    }

}