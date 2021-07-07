<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasbeehCounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasbeeh_counter', function (Blueprint $table) {
            $table->id();
            $table->string('zikar');
            $table->string('counter');
            $table->string('lap')->default(1)->nullable();
            $table->string('counted')->default(0)->nullable();
            $table->string('total_count')->default(0)->nullable();
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
        Schema::dropIfExists('tasbeeh_counter');
    }
}
