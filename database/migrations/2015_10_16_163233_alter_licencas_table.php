<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLicencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licencas', function (Blueprint $table) {
            
            // Adicionar o campo número nas licenças

            $table->string('numero')->after('validade');

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
            
            // Remover a coluna número

            $table->dropColumn('numero');

        });
    }
}
