<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCollunsTableTutorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutorial', function (Blueprint $table) {
            $table->dropColumn('path_foto');
            $table->dropColumn('link_video');
            $table->dropColumn('observacao');
            $table->dropColumn('passo_numero');
        });
    }
}
