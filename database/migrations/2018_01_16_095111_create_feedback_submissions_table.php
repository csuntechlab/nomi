<?php

declare(strict_types=1);
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbackSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedback_submissions', function (Blueprint $table) {
            $table->increments('submission_id');
            $table->string('application_name')->nullable();
            $table->string('user_id');
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('feedback_submissions');
    }
}
