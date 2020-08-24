<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_group', function (Blueprint $table) {
            $table->foreignId('entry_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('档案条目ID');
            $table->foreignId('group_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('组ID');

            $table->index(['group_id', 'entry_id']);
            $table->unique(['group_id', 'entry_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_group');
    }
}
