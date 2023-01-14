<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('ref_number')->nullable();
            $table->string('address')->default('Harben House, Tickford St,');
            $table->string('postcode')->default('MK16 9EY');
            $table->string('country')->default('United Kingdom');
            $table->string('region')->default('South Central');
            $table->string('area')->default('Milton Keynes');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel_number')->default('01908 533350');
            $table->string('fax_number')->nullable();
            $table->date('date_registered')->default('17 01 1966');
            $table->string('sector')->nullable();
            $table->string('clients_status')->nullable();
            $table->boolean('include_in_mail_shots')->default(true);
            $table->boolean('word')->default(true);
            $table->boolean('sms')->default(true);
            $table->string('consultant')->nullable();
            $table->string('devision')->nullable();
            // $table->string('contacts')->nullable();  Array of Users as foreign key?
            // $table->string('primary_contact')->nullable(); User foreign key?
            $table->text('last_contact_log')->nullable(); // should it be an activity log model?
            $table->softDeletes();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
