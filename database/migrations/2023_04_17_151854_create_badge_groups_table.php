<?php

use App\Models\BadgeGroup;
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
        Schema::create('badge_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('icon_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('active')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        $datas = [
            'Points',
            //'Badges',
            'Levels',
            'Leaderboard'
        ];

        foreach ($datas as $data) {
            $group = new BadgeGroup();
            $group->name = $data;
            $group->active = 1;
            $group->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_groups');
    }
};
