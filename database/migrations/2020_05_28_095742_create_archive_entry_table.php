<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_entry', function (Blueprint $table) {
            $table->id();
            $table->string('archive_id', 20)->comment('档案编号');
            $table->foreignId('entry_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('档案条目ID');
            $table->unsignedInteger('quantity')->default(0)->comment('数量');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->comment('创建者ID');
            $table->foreignId('editor_id')
                ->constrained('users')
                ->comment('修改者ID');
            $table->timestamps();

            $table->foreign('archive_id')
                ->references('id')
                ->on('archives')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['archive_id', 'entry_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive_entry');
    }
}
