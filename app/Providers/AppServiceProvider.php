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
                                    ->where('renovada', 0)
                                    ->count();

        $qtds['avencer_lista'] = Licenca::where('validade', '<=', $data_maxima)
                                    ->where('validade', '>=', date('Y-m-d'))
                                    ->where('renovada', 0)
                                    ->take(5)
                                    ->get();

        // Obter a quantidade de licenças vencidas

        $qtds['vencidas'] = Licenca::where('validade', '<', date('Y-m-d'))
                                    ->where('renovada', 0)
                                    ->count();

        $qtds['vencidas_lista'] = Licenca::where('validade', '<', date('Y-m-d'))
                                    ->where('renovada', 0)
                                    ->take(5)
                                    ->get();

        view()->share('qtds', $qtds);

        /////////////////////////////////////////////// Extensões do Blade

        Blade::directive('numeral', function($expression){

            switch($expression)
            {
                case 1:
                    return "<php echo 'um'; ?>";
                    break;
                case 2:
                    return "<php echo 'dois'; ?>";
                    break;
                case 3:
                    return "<php echo 'três'; ?>";
                    break;
                case 4:
                    return "<php echo 'quatro'; ?>";
                    break;
                case 5:
                    return "<php echo 'cinco'; ?>";
                    break;
                case 6:
                    return "<php echo 'seis'; ?>";
                    break;
                case 7:
                    return "<php echo 'sete'; ?>";
                    break;
                case 8:
                    return "<php echo 'oito'; ?>";
                    break;
                case 9:
                    return "<php echo 'nove'; ?>";
                    break;
                case 10:
                    return "<php echo 'dez'; ?>";
                    break;
            }

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
