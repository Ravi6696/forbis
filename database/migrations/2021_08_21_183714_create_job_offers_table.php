<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->enum('contract_type', ['CDI', 'CSD', 'Provider', 'Internship'])->nullable();
            $table->enum('pace', ['face_to_face', 'partial_teleworking', 'telecomputing'])->nullable();
            $table->date('publication_date')->nullable();
            $table->longText('description')->nullable();
            $table->longText('presentation')->nullable();
            $table->longText('profile_sought')->nullable();
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
        Schema::dropIfExists('job_offers');
    }
}