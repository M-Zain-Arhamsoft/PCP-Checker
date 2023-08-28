<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSsbLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('ssb_leads', function (Blueprint $table) {
            $table->id(); // This sets 'id' as the primary key automatically
            $table->timestamps();
            $table->dateTime('documented_date')->default('2020-01-01 00:00:00');
            $table->bigInteger('case_id')->nullable();
            $table->string('uid', 250)->nullable();
            $table->string('source_id', 30)->nullable();
            $table->string('case_description', 250)->nullable();
            // Add more columns as per your schema
        });
    }

    public function down()
    {
        Schema::dropIfExists('ssb_leads');
    }
}
