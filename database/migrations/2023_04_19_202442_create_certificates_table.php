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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->string('background_image_path')->nullable();

            $table->boolean('show_title')->nullable();
            $table->string('title_data')->nullable();
            $table->string('title_position_x')->nullable();
            $table->string('title_position_y')->nullable();
            $table->string('title_font_size')->nullable();
            $table->string('title_font_family')->nullable();
            $table->string('title_font_color')->nullable();

            $table->boolean('show_body')->nullable();
            $table->string('body_data')->nullable();
            $table->string('body_position_x')->nullable();
            $table->string('body_position_y')->nullable();
            $table->string('body_font_size')->nullable();
            $table->string('body_font_family')->nullable();
            $table->string('body_font_color')->nullable();

            $table->boolean('show_students_name')->nullable();
            $table->string('student_name_position_x')->nullable();
            $table->string('student_name_position_y')->nullable();
            $table->string('student_name_font_size')->nullable();
            $table->string('student_name_font_family')->nullable();
            $table->string('student_name_font_color')->nullable();

            $table->boolean('show_date')->nullable();
            $table->string('date_position_x')->nullable();
            $table->string('date_position_y')->nullable();
            $table->string('date_font_size')->nullable();
            $table->string('date_font_family')->nullable();
            $table->string('date_font_color')->nullable();

            $table->boolean('show_signature')->nullable();
            $table->string('signature_image_path')->nullable();
            $table->string('signature_position_x')->nullable();
            $table->string('signature_position_y')->nullable();
            $table->string('signature_image_height')->nullable();
            $table->string('signature_image_width')->nullable();

            $table->boolean('show_footer')->nullable();
            $table->string('footer_data')->nullable();
            $table->string('footer_position_x')->nullable();
            $table->string('footer_position_y')->nullable();
            $table->string('footer_font_size')->nullable();
            $table->string('footer_font_family')->nullable();
            $table->string('footer_font_color')->nullable();

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
        Schema::dropIfExists('certificates');
    }
};
