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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('vat');       // NIF CIF.
            $table->string('legal_form');       // S.A., S.L., etc.
            $table->string('comercial_name')->nullable();   // Nombre comercial
            $table->text('descripción')->nullable(); // Descripción opcional
            $table->string('address')->nullable();          // Dirección
            $table->string('town')->nullable();             // Ciudad
            $table->string('zip')->nullable();              // Código postal
            $table->string('province')->nullable();         // Provincia
             // Clave foránea al país
            $table->foreignId('country_id')->nullable();

            $table->timestamps();
            $table->softDeletes()->index();
            $table->foreignId('created_user');
            $table->foreignId('updated_user')->nullable();
           
            $table->string('phone')->nullable(); // Teléfono opcional
            $table->string('email')->nullable(); // Email opcional
            $table->string('website')->nullable(); // Sitio web opcional
            $table->string('logo')->nullable(); // Logo opcional

             $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
