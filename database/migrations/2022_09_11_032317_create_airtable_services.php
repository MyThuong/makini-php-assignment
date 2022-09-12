<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtableServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtable_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->unsignedBigInteger('service_group_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();

            $table->string('name')->nullable();
            $table->text('instructions')->nullable();
            $table->string('condition')->nullable();
            $table->boolean('recurring');
            $table->integer('calendar_interval')->nullable();
            $table->string('calendar_interval_unit')->nullable();
            $table->integer('running_hours_interval')->nullable();
            $table->integer('alternative_interval')->nullable();
            $table->text('alternative_interval_description')->nullable();

            $table->foreign('service_group_id')->references('id')->on('airtable_services')->onDelete('set null');
            $table->foreign('model_id')->references('id')->on('airtable_models')->onDelete('set null');

            $table->index(['ref_id', 'service_group_id']);

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
        Schema::dropIfExists('airtable_services');
    }
}
