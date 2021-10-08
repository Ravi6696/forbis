<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('title', 100)->nullable();
            $table->longText('sub_title', 100)->nullable();
            $table->text('content')->nullable();
            $table->text('attachment')->nullable();
            $table->integer('facebook_likes')->default(0);
            $table->integer('twitter_likes')->default(0);
            $table->integer('instagram_likes')->default(0);
            $table->integer('linkedin_likes')->default(0);
            $table->enum('status', [0, 1])->default(1);
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
        Schema::dropIfExists('blogs');
        Schema::enableForeignKeyConstraints();
    }
}
