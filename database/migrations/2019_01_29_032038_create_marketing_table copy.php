<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('marketing')) {
            Schema::create('marketing', function (Blueprint $table) {
               
                $table->string('college_tutorial_name', '100');
                $table->string('name', '50')->nullable();
                $table->string('area', '100')->nullable();
                $table->string('mobile1', '10')->nullable();
                $table->string('mobile2', '10')->nullable();
                $table->string('email', '100')->nullable();
                $table->string('father', '100')->nullable();
                $table->string('father_mobile', '10')->nullable();
                $table->string('cat', '10')->nullable();
                $table->string('school_per', '10')->nullable();
                $table->string('address', '10')->nullable();
                $table->string('pin', '10')->nullable();
                $table->string('district', '10')->nullable();
                $table->string('stafname', '10')->nullable();
                $table->string('remark', '10')->nullable();
                $table->string('date_followup', '10')->nullable();

                $table->string('extra_info', '1000');

            

                $table->boolean('status')->default(1);
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
        Schema::dropIfExists('marketing');
    }
}
