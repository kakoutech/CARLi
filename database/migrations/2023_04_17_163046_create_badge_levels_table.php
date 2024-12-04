<?php

use App\Models\Badge;
use App\Models\BadgeLevel;
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
        Schema::create('badge_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('condition')->default(0)->nullable();
            $table->boolean('active')->default(1)->nullable();
            $table->timestamps();
        });


        $datas = [
            'Activity', 'Registration', 'Learning', 'Course Count', 'Course Rating', 'Perfectionism', 'Communication', 'Certification'
        ];

        foreach ($datas as $data) {
            $badge = new Badge();
            $badge->name = $data;
            $badge->save();

            $count = 1;
            foreach ([
                ['Newbie', 4],
                ['Grower', 8],
                ['Adventurer', 16],
                ['Explorer', 32],
                ['Star', 64], 
                ['Superstar', 128], 
                ['Master', 256], 
                ['Grandmaster', 512],
            ] as $level) {
                
                $_level = new BadgeLevel();
                $_level->badge_id = $badge->id;
                $_level->name = $level[0];
                $_level->condition = $level[1];
                $_level->image_path = 'assets/badges/' . $count . '.png';
                $_level->save();

                $count++;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_levels');
    }
};
