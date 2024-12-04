<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strategy_tool_article_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('strategy_tool_article_id')->nullable();
            $table->unsignedBigInteger('resource_id')->nullable();
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
        Schema::dropIfExists('strategy_tool_article_resources');
    }
};
