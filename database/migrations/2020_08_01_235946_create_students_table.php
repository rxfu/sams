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
            $table->string('name', 60)->nullable()->comment('姓名');
            $table->string('idtype_id', 10)->nullable()->comment('证件类型ID');
            $table->string('idnumber', 20)->nullable()->comment('证件号码');
            $table->string('gender_id', 2)->nullable()->comment('性别ID');
            $table->string('nation_id', 20)->nullable()->comment('民族ID');
            $table->string('department_id', 10)->nullable()->comment('学院ID');
            $table->string('major_id', 10)->nullable()->comment('专业ID');
            $table->string('grade', 4)->nullable()->comment('年级');
            $table->string('duration', 1)->nullable()->comment('学制');
            $table->string('status', 20)->nullable()->comment('学籍状态，0-不在校，1-在校');
            $table->string('level', 20)->nullable()->comment('培养层次，1-本科生，2-研究生');
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
