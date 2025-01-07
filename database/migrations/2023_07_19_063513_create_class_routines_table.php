<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_routines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

//            $table->unsignedInteger('faculty_id');
//            $table->unsignedInteger('semester_id');
//            $table->unsignedInteger('subject_id');
//
//            $table->unsignedInteger('day_id');
//            $table->unsignedInteger('staff_id')->nullable();
//            table->string('room')->nullable();
//            table->string('time')->nullable();
//
//            $table->smallInteger('sorting')->default(0);
//            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_routines');
    }
}
