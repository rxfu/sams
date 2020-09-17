<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->string('id', 10)->unique()->comment('专业代码');
            $table->string('name', 64)->comment('名称');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-未启用，1-启用');
            $table->string('department_id', 10)->comment('学院ID');
            $table->text('description')->nullable()->comment('描述');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('majors');
    }
}
