<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('safe_name')->unique();
            $table->integer('position')->unsigned();
            $table->enum('type', array('public', 'semipublic', 'private'));
            $table->boolean('enabled')->default(true);
            $table->boolean('can_publish')->default(false);
            $table->timestamps();
            $table->timestamp('published_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packs');
    }
}
