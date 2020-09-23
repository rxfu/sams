<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idtypes', function (Blueprint $table) {
            $table->string('id', 10)->comment('证件类型代码');
            $table->string('name', 64)->unique()->comment('名称');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-未启用，1-启用');
            $table->text('description')->nullable()->comment('描述');

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
        Schema::dropIfExists('idtypes');
    }
}
