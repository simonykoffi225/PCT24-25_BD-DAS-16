<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('type_localite', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_localite');
    }
};
