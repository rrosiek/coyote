<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrotherRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brother_relations', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('little_id');
            $table->primary(['user_id', 'little_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('little_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brother_relations', function (Blueprint $table) {
            $table->dropForeign('brother_relations_user_id_foreign');
            $table->dropForeign('brother_relations_little_id_foreign');
        });

        Schema::dropIfExists('brother_relations');
    }
}
