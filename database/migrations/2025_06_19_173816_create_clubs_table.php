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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('federation_cod');         // código federación del club
            $table->string('federation_name');        // nombre de la federación del club
            $table->string('federation_url')->nullable(); // URL de la federación del club
            $table->string('federation_logo')->nullable(); // Logo de la federación del club
            $table->string('federation_email')->nullable(); // Email de la federación del club
            $table->string('federation_phone')->nullable(); // Teléfono de la federación del club
            
            $table->string('name');                   // Nombre del club
            $table->text('obsrvations')->nullable();  // Observaciones opcionales
            $table->string('address')->nullable();    // Dirección
            $table->string('town')->nullable();       // Localidad
            $table->string('province')->nullable();               // Provincia
            $table->foreignId('country_id')->nullable();          // Relación con país
            $table->string('logo')->nullable();       // Ruta o nombre del logo
            $table->string('phone')->nullable();      // Teléfono opcional
            $table->string('email')->nullable();      // Email opcional
            $table->string('website')->nullable();    // Sitio web opcional

            $table->timestamps();
            $table->softDeletes()->index();
            $table->foreignId('created_user');
            $table->foreignId('updated_user')->nullable();
          
            // Claves foránea
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
        Schema::dropIfExists('clubs');
    }
};
