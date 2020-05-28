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
            $table->string('card_number', 18)->nullable()->comment('证件号码');
            $table->date('received_at')->nullable()->comment('接收时间');
            $table->string('name', 50)->nullable()->comment('姓名');
            $table->string('department_id', 2)->nullable()->comment('学院');
            $table->string('major_id', 7)->nullable()->comment('专业');
            $table->string('grade', 4)->nullable()->comment('年级');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->comment('创建者ID');
            $table->foreignId('editor_id')
                ->constrained('users')
                ->comment('修改者ID');
            $table->text('remark')->nullable()->comment('备注');
            $table->timestamps();

            $table->primary('id');
            $table->index('sid');
            $table->index('card_number');
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
