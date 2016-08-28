<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pack_id')->unsigned()->index();
            $table->string('version', 32)->index();
            $table->integer('minecraft_version_id')->unsigned();
            $table->boolean('is_development')->default(true);
            $table->text('changelog')->nullable()->default(null);
            $table->text('xml')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->integer('created_by')->unsigned();
            $table->integer('published_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->datetime('published_at')->nullable()->default(null);
        });

        Schema::table('pack_versions', function (Blueprint $table) {
            $table->foreign('pack_id')->references('id')->on('packs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pack_versions', function (Blueprint $table) {
            $table->foreign('minecraft_version_id')->references('id')->on('minecraft_versions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pack_versions', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pack_versions', function (Blueprint $table) {
            $table->foreign('published_by')->references('id')->on('users')
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
        Schema::drop('pack_versions');
    }
}
