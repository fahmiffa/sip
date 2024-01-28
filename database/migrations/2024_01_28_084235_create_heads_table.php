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
        Schema::create('heads', function (Blueprint $table) {
            $table->id();
            $table->string('name');           
            $table->bigInteger('parent')->nullable();  
            $table->bigInteger('verification_id')->nullable(); 
            $table->bigInteger('consultations_id')->nullable();                     
            $table->enum('type',['menara','umum']);      
            $table->Integer('status');
            $table->bigInteger('verifikator')->nullable();  
            $table->bigInteger('sekretariat')->nullable();  
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heads');
    }
};
