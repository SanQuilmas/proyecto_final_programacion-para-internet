<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('autor_libros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBiginteger('autor_id');
            $table->unsignedBiginteger('libro_id');


            $table->foreign('autor_id')->references('id')
                 ->on('autors')->onDelete('cascade');
            $table->foreign('libro_id')->references('id')
                ->on('libros')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autor_libros');
    }
};
