<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('staff')) {
            Schema::create('staff', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->unsignedInteger('created_by');
                $table->unsignedInteger('last_updated_by')->nullable();

                $table->string('reg_no', '15')->unique();
                $table->dateTime('join_date');
                $table->unsignedInteger('designation');

                $table->string('first_name', '50');
                $table->string('middle_name', '15')->nullable();
                $table->string('last_name', '15')->nullable();
                $table->string('father_name', '50')->nullable();
                $table->string('mother_name', '50')->nullable();
                $table->dateTime('date_of_birth');
                $table->string('gender', '10')->nullable();
                $table->string('blood_group', '10')->nullable();
                $table->string('nationality', '50')->nullable();
                $table->string('national_id_1', '25')->nullable();
                $table->string('national_id_2', '25')->nullable();
                $table->string('national_id_3', '25')->nullable();
                $table->string('national_id_4', '25')->nullable();

                $table->string('address', '100')->nullable();
                $table->string('state', '25')->nullable();
                $table->string('country', '25')->nullable();
                $table->string('postal_code', '25')->nullable();

                $table->string('temp_address', '100')->nullable();
                $table->string('temp_state', '25')->nullable();
                $table->string('temp_country', '25')->nullable();
                $table->string('temp_postal_code', '25')->nullable();

                $table->string('home_phone', '15')->nullable();
                $table->string('mobile_1', '15')->nullable();
                $table->string('mobile_2', '15')->nullable();

                $table->string('mother_tongue', '50')->nullable();
                $table->string('email', '100')->nullable();

                $table->string('qualification', '100')->nullable();
                $table->string('experience', '100')->nullable();
                $table->string('experience_info', '100')->nullable();

                $table->integer('basic_salary')->nullable();
                $table->dateTime('date_of_relieving')->nullable();
                $table->dateTime('date_of_rejoin')->nullable();

                $table->text('bank_name')->nullable();
                $table->text('bank_account_number')->nullable();
                $table->text('bank_code')->nullable();

                $table->string('other_info', '100')->nullable();

                $table->text('staff_image')->nullable();
                $table->boolean('status')->default(1);

                $table->foreign('designation')->references('id')->on('staff_designations');
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
