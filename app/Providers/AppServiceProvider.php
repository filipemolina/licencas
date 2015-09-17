<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
        * Criar um novo comando no Blade que compara duas URL's e retorna 'active' se elas forem iguais.
        * Esse comando deve ser usado no atributo 'class' de links de navegação
        * 
        * @param url1 => URL atual da página
        * @param url2 => URL do link que se quer testar
        * 
        * @return string
        */

        Blade::directive('isActiveUrl', function($urls){

            if($urls[0] == $urls[1])
                return 'active ';
            else
                return '';

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
