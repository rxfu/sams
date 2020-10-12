<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major_user', function (Blueprint $table) {
            $table->string('major_id', 10)->comment('专业ID');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('用户ID');

            $table->foreign('major_id')->on('majors')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->index(['user_id', 'major_id']);
            $table->unique(['user_id', 'major_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('major_user');
    }
}
