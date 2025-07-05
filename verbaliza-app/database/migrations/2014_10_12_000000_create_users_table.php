<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ficheiro: /database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php
     * (Este ficheiro é gerado por defeito no Laravel)
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); // Cria as colunas created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
