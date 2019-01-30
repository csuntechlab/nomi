<?php

declare(strict_types=1);
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('support_submissions', function (Blueprint $table) {
            $table->increments('submission_id');
            $table->string('application_name')->nullable();
            $table->string('user_id');
            $table->string('impact');
            $table->text('content');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));	
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('support_submissions');
    }
}
