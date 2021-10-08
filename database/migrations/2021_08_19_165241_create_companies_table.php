<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email', 100)->nullable();
            $table->bigInteger('telephone')->nullable();
            $table->bigInteger('mobile_no')->nullable();
            $table->text('website')->nullable();
            $table->enum('is_collect', [1, 0])->default(0)->comment('1-yes,0-no');
            $table->text('collect_link')->nullable();
            $table->enum('is_delivery', [1, 0])->default(0)->comment('1-yes,0-no');
            $table->text('delivery_link')->nullable();
            $table->text('other_link')->nullable();
            $table->text('company_logo')->nullable();
            $table->integer('followers')->default(0);
            $table->longText('about_us')->nullable();
            $table->text('reservation_link')->nullable();
            $table->enum('is_show_reservation_link', [true, false])->default(true);
            $table->enum('is_show_about_us', [true, false])->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('companies');
        Schema::enableForeignKeyConstraints();
    }
}