<?php

declare(strict_types=1);
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('theme', function (Blueprint $table) {
            $table->string('user_id', 128);
            $table->string('theme', 256);

            $table->unique('user_id');
            $table->primary('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('theme');
    }
}
