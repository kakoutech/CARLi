<?php

use App\Models\CourseType;
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
        Schema::create('course_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('active')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        foreach (['Online', 'Distance Learning', 'Face-to-Face'] as $item) {
            $_item = new CourseType();
            $_item->name = $item;
            $_item->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_types');
    }
};
