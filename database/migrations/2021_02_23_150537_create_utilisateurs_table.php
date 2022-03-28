<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->engine = 'InnoDb';
            $table->increments('idUtilisateur');
            $table->string('nomUtilisateur')->unique();
            $table->char('nom', 50)->unique();
            $table->char('prenom', 50)->unique();
            $table->char('mail', 50)->unique();
            $table->char('motDePasseUtilisateur');
            $table->boolean('estInscrit')->default(false); // 0 : attente de validation , 1 : refusé, 2 : validé
            $table->boolean('isAdministrateur')->default(false);
            $table->boolean('motDePasseOublie')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
