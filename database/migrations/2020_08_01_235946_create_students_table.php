<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('id', 12)->comment('学号');
            $table->string('name', 60)->comment('姓名');
            $table->string('card_type', 10)->comment('证件类型');
            $table->string('card_id', 18)->comment('证件号码');
            $table->string('gender', 2)->comment('性别');
            $table->string('nation', 20)->comment('民族');
            $table->string('department_id', 10)->comment('学院ID');
            $table->string('major_id', 10)->comment('专业ID');
            $table->string('grade', 4)->comment('年级');
            $table->string('duration', 1)->comment('学制');
            $table->string('status', 20)->comment('学籍状态');
            $table->string('level', 20)->comment('培养层次');
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
        Schema::dropIfExists('students');
    }
}
