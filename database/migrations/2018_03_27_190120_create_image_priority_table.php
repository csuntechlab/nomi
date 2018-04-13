<?php

declare(strict_types=1);
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagePriorityTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('image_priority', function (Blueprint $table) {
            $table->string('student_id', 128);
            $table->string('image_priority', 128);
            $table->timestamps();

            $table->unique('student_id');
            $table->primary('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('image_priority');
    }
}
