<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prets', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->float('reste_a_payer');
            $table->float('taux');
            $table->date('delais');
            $table->boolean('est_accepter')->nullable();
            $table->unsignedBigInteger('demande_id')->index('demande_id');
            $table->foreign('demande_id')->references('id')->on('demandes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prets');
    }
};
