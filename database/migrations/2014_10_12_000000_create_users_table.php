<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('forename');
            $table->string('surname')->nullable();
            $table->string('ref_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // 
            $table->timestamp('date_registered')->nullable();
            $table->string('address')->default('Harben House, Tickford St,');
            $table->string('postcode')->default('MK16 9EY');
            $table->string('country')->default('United Kingdom');
            $table->string('region')->default('South Central');
            $table->string('area')->default('Milton Keynes');
            $table->string('tel_number')->default('01908 533350');
            $table->string('mobile_phone')->default('075600666444');
            $table->string('work_tel')->nullable();
            $table->date('date_of_birth')->default('17 01 1966');
            $table->integer('age')->default(57); // calculate here ?
            $table->string('nationality')->default('British');
            $table->string('ethnic_origin')->nullable();
            // 
            //Foreign Key
            $table->foreignId('user_status')->nullable()->references('id')->on('user_statuses')->onDelete('cascade');
            // constrained() = references('id')->on('authors')

            $table->boolean('include_in_mail_shots')->default(true);
            $table->boolean('word')->default(true);
            // $table->boolean('email')->default(true); dublicate column name
            $table->boolean('sms')->default(true);
            $table->text('notes')->nullable();
            $table->text('last_contact_log')->nullable();



            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
