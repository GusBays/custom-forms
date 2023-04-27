<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_field_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->foreignId('form_id');
            $table->foreignId('field_id');
            $table->foreignId('filler_id');
            $table->json('answer');
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('form_id')
                ->references('id')
                ->on('forms')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('field_id')
                ->references('id')
                ->on('form_fields')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('filler_id')
                ->references('id')
                ->on('fillers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_field_answers');
    }
}
