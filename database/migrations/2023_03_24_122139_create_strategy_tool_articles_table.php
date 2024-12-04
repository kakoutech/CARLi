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
        Schema::create('strategy_tool_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('strategy_tool_topic_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('content')->nullable();
            $table->string('icon_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('strategy_tool_articles');
    }
};
