<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freshorganicvegetables', function (Blueprint $table) {
            $table->id('freshorganicvegetables_id');
            $table->string('tag');
            $table->string('image');
            $table->string('title');
            $table->longText('description');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freshorganicvegetables');
    }
};
