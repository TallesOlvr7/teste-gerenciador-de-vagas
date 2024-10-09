<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_vacancy', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('vacancy_id')->constrained('vacancies');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('user_vacancy');
    }
};
