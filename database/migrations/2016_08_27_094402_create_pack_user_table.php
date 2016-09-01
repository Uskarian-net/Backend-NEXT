<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('pack_id')->unsigned();
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('pack_user', function (Blueprint $table) {
            $table->unique(['user_id', 'pack_id']);
        });

        Schema::table('pack_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pack_user', function (Blueprint $table) {
            $table->foreign('pack_id')->references('id')->on('packs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pack_user', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pack_user');
    }
}
