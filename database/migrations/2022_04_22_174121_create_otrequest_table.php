<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ps_request_ot_listing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('emp_id')->default('0')->nullable();
            $table->string('full_name')->default('')->nullable();
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('work_done')->default('')->nullable();
            $table->string('location')->default('')->nullable();
            $table->double('hours_request')->default('0')->nullable();
            $table->double('hours_approve')->default('0')->nullable();
            $table->char('status')->default('')->nullable()->length(1);
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
        Schema::dropIfExists('tbl_ps_request_ot_listing');
    }
}
