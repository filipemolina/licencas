<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncluirNProcessoEmLicencas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licencas', function (Blueprint $table) {
            
            $table->string('n_processo')->after('numero');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('licencas', function (Blueprint $table) {
            
            // Remover o campo

            $table->dropColumn('n_processo');

        });
    }
}
