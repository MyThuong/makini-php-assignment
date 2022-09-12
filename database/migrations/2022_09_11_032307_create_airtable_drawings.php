<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtableDrawings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtable_drawings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->string('name')->nullable();
            $table->index(['name', 'ref_id']);
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
        Schema::dropIfExists('airtable_drawings');
    }
}
