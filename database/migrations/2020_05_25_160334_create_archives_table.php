<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->string('id', 20)->comment('档案编号');
            $table->string('sid', 12)->comment('学号');
            $table->string('name', 50)->comment('姓名');
            $table->string('department_id', 2)->comment('学院');
            $table->string('major_id', 7)->comment('专业');
            $table->string('grade', 4)->comment('年级');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
