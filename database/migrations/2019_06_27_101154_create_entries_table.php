<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company');
            $table->unsignedInteger('subject_id');
            $table->boolean('anonymous');
            $table->text('person')->nullable();
            $table->text('who');
            $table->text('what');
            $table->text('where');
            $table->text('when');
            $table->text('how');
            $table->unsignedInteger('attachment_id')->nullable();
            $table->text('why');
            $table->text('already_done');
            $table->boolean('agree');
            $table->binary('hash');
            $table->unsignedInteger('status_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
