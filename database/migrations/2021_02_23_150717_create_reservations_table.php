<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('idReservation');
            $table->integer("positionFileAttente")->nullable();
            $table->integer('numeroPlace')->nullable()->unsigned();
            $table->integer('utilisateur')->nullable()->unsigned();
            $table->string("etatReservation")->nullable();
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();
            $table->foreign('numeroPlace')
                ->references('idParking')
                ->on('parkings');
            $table->foreign('utilisateur')
                ->references('idUtilisateur')
                ->on('utilisateurs');
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
        Schema::dropIfExists('reservations');
    }
}
