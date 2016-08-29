<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLauncherVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('launcher_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version', 16)->index();
            $table->integer('created_by')->unsigned();
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('launcher_versions', function (Blueprint $table) {
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
        Schema::drop('launcher_versions');
    }
}
