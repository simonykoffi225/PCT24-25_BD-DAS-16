<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeureDecesToActeDecesTable extends Migration
{
    public function up()
    {
        Schema::table('acte_deces', function (Blueprint $table) {
            $table->time('heure_deces')
                  ->nullable()
                  ->after('lieu_deces');
        });
    }

    public function down()
    {
        Schema::table('acte_deces', function (Blueprint $table) {
            $table->dropColumn('heure_deces');
        });
    }
}
