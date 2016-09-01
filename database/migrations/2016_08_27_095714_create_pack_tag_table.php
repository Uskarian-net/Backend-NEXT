<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pack_id')->unsigned()->index();
            $table->string('tag', 64)->index();
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('pack_tag', function (Blueprint $table) {
            $table->unique(['pack_id', 'tag']);
        });

        Schema::table('pack_tag', function (Blueprint $table) {
            $table->foreign('pack_id')->references('id')->on('packs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pack_tag', function (Blueprint $table) {
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
        Schema::drop('pack_tag');
    }
}
