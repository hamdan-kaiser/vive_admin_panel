<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
			$table->enum('course_type',['under_graduation', 'post_graduation']);
			$table->integer('subject_id');
			$table->integer('university_id');
			$table->string('surname');
			$table->string('given_name');
			$table->string('email');
			$table->string('date_of_birth');
			$table->text('address');
			$table->string('passport_no');
			$table->date('expiry_date');
			$table->string('ielts_score');
			$table->string('passport_file');
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
        Schema::dropIfExists('applications');
    }
}
