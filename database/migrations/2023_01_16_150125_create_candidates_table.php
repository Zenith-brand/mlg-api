<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ref_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel_number')->default('01908 533350');
            $table->string('fax_number')->nullable();
            $table->date('date_registered')->default('2016-09-12');
            $table->string('sector')->nullable();
            $table->string('clients_status')->nullable();
            $table->boolean('include_in_mail_shots')->default(true);
            $table->boolean('word')->default(true);
            $table->boolean('sms')->default(true);
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
        Schema::dropIfExists('candidates');
    }
}
