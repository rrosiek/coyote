<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('detail')->nullable();
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('end_date')->nullable();
            $table->boolean('all_day')->default(false);
            $table->string('frequency')->nullable();
            $table->integer('interval')->default(1);
            $table->string('by_day')->nullable();
            $table->integer('by_set_pos')->nullable();
            $table->dateTimeTz('until')->nullable();
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
        Schema::dropIfExists('events');
    }
}
