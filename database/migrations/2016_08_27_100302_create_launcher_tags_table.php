<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLauncherTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('launcher_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pack_id')->unsigned()->index();
            $table->string('tag', 64)->index();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('launcher_tags', function (Blueprint $table) {
            $table->unique(['pack_id', 'tag']);
        });

        Schema::table('launcher_tags', function (Blueprint $table) {
            $table->foreign('pack_id')->references('id')->on('packs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('launcher_tags', function (Blueprint $table) {
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
        Schema::drop('launcher_tags');
    }
}
