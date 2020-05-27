<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('archive_id', 20)->comment('档案编号');
            $table->string('forward')->nullable()->comment('投递去向');
            $table->integer('status')->default(0)->comment('投递状态，0-未投递，1-已投递，2-被退回');
            $table->string('receiver', 128)->nullable()->comment("收件人");
            $table->string('phone', 20)->nullable()->comment("联系电话");
            $table->string('address')->nullable()->comment("地址");
            $table->boolean('had_receipt')->default(false)->comment('是否有回执，0-无，1-有');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->comment('创建者ID');
            $table->foreignId('editor_id')
                ->constrained('users')
                ->comment('修改者ID');
            $table->unsignedInteger('version')->default(1)->comment('投递次数');
            $table->text('remark')->nullable()->comment('备注');
            $table->timestamps();

            $table->foreign('archive_id')->references('id')->on('archives')->onDelete('cascade')->onUpdate('cascade');
            $table->index('archive_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
