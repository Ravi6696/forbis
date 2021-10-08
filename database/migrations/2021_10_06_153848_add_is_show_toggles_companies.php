<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsShowTogglesCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->boolean('is_toggle_apropos')->deafult(true);
            $table->boolean('is_toggle_horaire')->deafult(true);
            $table->boolean('is_toggle_avis')->deafult(true);
            $table->boolean('is_toggle_coordonnees')->deafult(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('is_toggle_apropos');
            $table->dropColumn('is_toggle_horaire');
            $table->dropColumn('is_toggle_avis');
            $table->dropColumn('is_toggle_coordonnees');
        });
    }
}
