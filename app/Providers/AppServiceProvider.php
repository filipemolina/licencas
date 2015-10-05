<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

use App\Licenca;

class AppServiceProvider extends ServiceProvider
{
    protected $antecedencia = "+6 months";

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ///////////////////////////////////////////// Definir as quantidades que são mostradas no topo

        $qtds = [];

        // Obter a quantidade de licencas renovadas

        $qtds['renovadas'] = Licenca::where('renovada', 1)->count();

        // Obter a quantidade de licenças à vencer

        $data_maxima = date('Y-m-d', strtotime($this->antecedencia));

        $qtds['avencer'] = Licenca::where('validade', '<=', $data_maxima)
                                    ->where('validade', '>=', date('Y-m-d'))
                                    ->count();

        // Obter a quantidade de licenças vencidas

        $qtds['vencidas'] = Licenca::where('validade', '<', date('Y-m-d'))
                                    ->where('renovada', 0)
                                    ->count();

        view()->share('qtds', $qtds);
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
