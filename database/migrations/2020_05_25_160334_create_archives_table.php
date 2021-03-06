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
            $table->string('sid', 12)->unique()->comment('学号');
            $table->date('received_at')->nullable()->comment('接收时间');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->comment('创建者ID');
            $table->foreignId('editor_id')
                ->constrained('users')
                ->comment('修改者ID');
            $table->boolean('is_archived')->default(false)->comment('是否归档，0-未归档，1-已归档');
            $table->text('remark')->nullable()->comment('备注');
            $table->timestamps();

            $table->primary('id');
            $table->index('sid');
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
