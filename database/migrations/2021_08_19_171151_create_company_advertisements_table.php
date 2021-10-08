<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAdvertisementsTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('invoice_number', 8)->nullable();
            $table->string('name', 50)->nullable();
            $table->text('attachment')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('description')->nullable();
            $table->text('redirection_link')->nullable();
            $table->enum('is_send_dashboard', [1, 0])->default(0)->comment('0-No,1-Yes');
            $table->enum('is_renewable', [1, 0])->default(0)->comment('0-No,1-Yes');
            $table->enum('status', [1, 0])->default(1)->comment('0-InActive,1-Active');
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
        Schema::dropIfExists('company_advertisements');
        Schema::enableForeignKeyConstraints();
    }
}
