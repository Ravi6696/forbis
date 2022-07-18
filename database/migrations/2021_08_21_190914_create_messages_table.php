<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_id');
            // $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('receiver_id');
            // $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('message')->nullable();
            $table->enum('is_read', [1, 0])->default(0)->comment('1-Yes,0-No');
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
        Schema::dropIfExists('messages');
    }
}