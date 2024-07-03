<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passport_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('given_name');
            $table->string('surname');
            $table->string('passport_no');
            $table->date('date_of_birth');
            $table->text('address');
            $table->float('ielts_score');
            $table->date('passport_expire');
            $table->string('passport_image');
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
        Schema::dropIfExists('passport_profiles');
    }
}
