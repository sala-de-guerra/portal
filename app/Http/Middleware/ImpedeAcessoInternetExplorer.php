<?php

namespace App\Http\Middleware;

use Closure;

class ImpedeAcessoInternetExplorer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
        if(count($matches)<2)
        {
        preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
        }

        if (count($matches) > 1 && $matches[1] <= 11)
        {
            echo "
                    <h1> 
                        Por gentileza, utilizar o Mozilla Firefox ou o Google Chrome para acessar o site.
                    </h1> 
                    
                    <p>Estamos trabalhando para compatibilizar nossos sistemas com esse navegador. </p>
                    
                    <p>link: 
                        <a href ='" . $request->url() . "'> 
                            Copie o Link 
                        </a>
                    </p>

                    <center> <img src='" . asset('img/ie_naum.jpg') . "'> <center>

                ";
            die();
        }
        return $next($request);
    }
}