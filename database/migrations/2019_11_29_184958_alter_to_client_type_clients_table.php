<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Comando Artisan: php artisan make:migration alter_to_client_type_clients_table --table=clients
 * Migração para alterar tabela, adicionando campos. Relacionando tabela com --table=clients
 * OBS: quando rodar essa migration 
 * 1º vez, irá gerar um erro caso não tenha Doctrine DBAL, precisa instalar para rodar.
 * 2º vez, contornar erro de dados primitivos do DB para Doctrine entender(como ENUM e CHAR abaixo),
 * ir em App\Providers\AppServiceProvider.php no método boot().
 * 
 * ATENÇÃO: caso continue gerando Erros, fazer de forma manual chamando classe DB de forma estática
 * Ex: \DB::statement();
 */
class AlterToClientTypeClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('document_number')->unique()->change();
            $table->date('date_birth')->nullable()->change();
            \DB::statement('ALTER TABLE clients CHANGE COLUMN sex sex CHAR NULL');
            //$table->char('sex', 10)->nullable()->change();
            $maritalStatus = array_keys(\App\Client::MARITAL_STATUS);
            $maritalStatusString = array_map(function ($value) {
                return "'$value'";
            }, $maritalStatus);
            $maritalStatusEnum = implode(',', $maritalStatusString);
            \DB::statement("ALTER TABLE clients CHANGE COLUMN marital_status marital_status ENUM($maritalStatusEnum) NULL");
            //$table->enum('marital_status', array_keys(\App\Client::MARITAL_STATUS))->nullable()->change();
            $table->string('company_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique('clients_document_number_unique');
            $table->date('date_birth')->change();
            \DB::statement('ALTER TABLE clients CHANGE COLUMN sex sex CHAR NOT NULL');
            //$table->char('sex', 10)->change();
            $maritalStatus = array_keys(\App\Client::MARITAL_STATUS);
            $maritalStatusString = array_map(function ($value) {
                return "'$value'";
            }, $maritalStatus);
            $maritalStatusEnum = implode(',', $maritalStatusString);
            \DB::statement("ALTER TABLE clients CHANGE COLUMN marital_status marital_status ENUM($maritalStatusEnum) NOT NULL");
            //$table->enum('marital_status', array_keys(\App\Client::MARITAL_STATUS))->change();
            $table->dropColumn('company_name');
        });
    }
}
