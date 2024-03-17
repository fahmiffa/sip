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
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigInteger('parent')->nullable(); 
            $table->bigInteger('head')->nullable();                
            $table->json('parameter');  
            $table->json('hitung');  
            $table->json('prasarana');  
            $table->date('tanggal');  
            $table->integer('status');              
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};