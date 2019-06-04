<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_project', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('material_id');
            $table->unsignedInteger('project_id');
            $table->integer('amount')->unsigned();
            $table->string('recipient');

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('material_project');
    }
}
