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
            $table->string('xh', 12)->comment('学号');
            $table->string('xm', 60)->comment('姓名');
            $table->string('card_type', 10)->comment('证件类型');
            $table->string('sfzjh', 18)->comment('证件号码');
            $table->string('xbm', 2)->comment('性别');
            $table->string('mzm', 20)->comment('民族');
            $table->string('dwh', 2)->comment('学院代码');
            $table->string('department', 60)->comment('学院');
            $table->string('zydm', 7)->comment('专业代码');
            $table->string('major', 60)->comment('专业');
            $table->string('dqszj', 4)->comment('年级');
            $table->string('xz', 1)->comment('学制');
            $table->string('sfzx', 20)->comment('学籍状态');
            $table->string('sjly', 20)->comment('培养层次');
            $table->timestamps();

            $table->primary('xh');
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
