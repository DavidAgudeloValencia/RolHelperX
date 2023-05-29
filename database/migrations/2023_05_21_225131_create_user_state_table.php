<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_state', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer("life");
            $table->integer("main_magic");
            $table->integer("secondary_magic");
            $table->integer("tertiary_magic");
            $table->integer("dice_4");
            $table->integer("dice_5");
            $table->integer("dice_6");
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
        Schema::dropIfExists('user_state');
    }
};
