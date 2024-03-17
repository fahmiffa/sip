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
        Schema::create('attaches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent')->nullable(); 
            $table->bigInteger('head')->nullable();             
            $table->string('luas');  
            $table->string('bukti');  
            $table->string('gambar');  
            $table->string('lokasi');  
            $table->string('lahan');  
            $table->string('koordinat');  
            $table->text('note');  
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
        Schema::dropIfExists('attaches');
    }
};
