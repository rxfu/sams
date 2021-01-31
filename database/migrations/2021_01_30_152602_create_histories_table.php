<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->string('id', 12)->comment('学号');
            $table->string('name', 60)->nullable()->comment('姓名');
            $table->string('idtype_id', 10)->nullable()->comment('证件类型ID');
            $table->string('idtype', 64)->nullable()->comment('证件类型');
            $table->string('idnumber', 20)->nullable()->comment('证件号码');
            $table->string('gender_id', 2)->nullable()->comment('性别ID');
            $table->string('gender', 64)->nullable()->comment('性别');
            $table->string('nation_id', 20)->nullable()->comment('民族ID');
            $table->string('nation', 64)->nullable()->comment('民族');
            $table->string('department_id', 10)->nullable()->comment('学院ID');
            $table->string('department', 64)->nullable()->comment('学院');
            $table->string('major_id', 10)->nullable()->comment('专业ID');
            $table->string('major', 64)->nullable()->comment('专业');
            $table->string('grade', 4)->nullable()->comment('年级');
            $table->string('duration', 1)->nullable()->comment('学制');
            $table->string('level', 16)->nullable()->comment('培养层次');
            $table->string('archive_id', 20)->comment('档案编号');
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
        Schema::dropIfExists('histories');
    }
}
