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
        Schema::create('zipcode', function (Blueprint $table) {
            $table->id();
            $table->string('UF');
            $table->string('CIDADE');
            $table->string('DEPARTAMENTO')->unique();
            $table->integer('CEP_INICIO_1')->nullable(false); // CEP_INICIO_1 nunca pode ser nulo
            $table->integer('CEP_INICIO_2')->nullable(false); // CEP_INICIO_2 nunca pode ser nulo
            $table->integer('CEP_FIM_1')->nullable(); // CEP_FIM_1 pode ser nulo
            $table->integer('CEP_FIM_2')->nullable(); // CEP_FIM_2 pode ser nulo
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zipcode');
    }
};
