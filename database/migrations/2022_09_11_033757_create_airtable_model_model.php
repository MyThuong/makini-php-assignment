<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtableModelModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtable_model_model', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->string('dwg_no')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('dwg_ref_no')->nullable();

            $table->unsignedBigInteger('dwg_id');
            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('parent_id');


            $table->foreign('child_id')->references('id')->on('airtable_models')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('airtable_models')->onDelete('cascade');
            $table->foreign('dwg_id')->references('id')->on('airtable_drawings');

            $table->index(['ref_id']);
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
        Schema::dropIfExists('airtable_model_model');
    }
}
