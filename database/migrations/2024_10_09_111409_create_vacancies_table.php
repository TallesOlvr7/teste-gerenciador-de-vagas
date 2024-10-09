<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->enum('type',['Pessoa Jurídica','Freelancer']);
            $table->enum('status',['Aberta', 'Fechada'])->default('Aberta');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
