<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('workOrderName');
            $table->integer('userId');
            $table->integer('formDept');
            $table->integer('toDept');
            $table->integer('idKategori');
            $table->integer('idLocation');
            $table->date('startWorkOrder');
            $table->date('endWorkOrder');
            $table->string('estimate');
            $table->text('description');
            $table->boolean('status')->default(0);
            $table->string('completeBy');
            $table->text('note');
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
        Schema::dropIfExists('work_orders');
    }
}
