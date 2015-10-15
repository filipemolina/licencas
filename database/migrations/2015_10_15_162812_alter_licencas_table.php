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

            // Criar uma coluna 'tipo_id' para relacionar a licença com o tipo de licença
            
            $table->integer('tipo_id')->after('empresa_id');
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
            
            // Remover a coluna tipo_id

            $table->dropColumn('tipo_id');
        });
    }
}
