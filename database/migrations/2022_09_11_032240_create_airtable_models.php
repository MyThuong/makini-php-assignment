<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtableModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtable_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->string('number')->nullable();
            $table->unsignedBigInteger('interchangeable_with_id')->nullable();
            $table->index(['ref_id', 'number', 'interchangeable_with_id']);

            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->string('note')->nullable();

            $table->foreign('interchangeable_with_id')
                ->references('id')
                ->on('airtable_models')
                ->onDelete('set null');

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
        Schema::dropIfExists('airtable_models');
    }
}
