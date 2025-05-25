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
    Schema::table('acte_deces', function (Blueprint $table) {
        $table->string('updated_by_status')->nullable()->after('statut');
        $table->text('motif_rejet')->nullable()->after('updated_by_status');
    });
}

public function down()
{
    Schema::table('acte_deces', function (Blueprint $table) {
        $table->dropColumn(['updated_by_status', 'motif_rejet']);
    });
}
};
