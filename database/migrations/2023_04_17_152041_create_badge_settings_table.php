<?php

use App\Models\BadgeGroup;
use App\Models\BadgeSetting;
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
        Schema::create('badge_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('badge_group_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('input_count')->default(0)->nullable();
            $table->string('pre_text')->nullable();
            $table->string('value')->nullable();
            $table->string('value_2')->nullable();
            $table->string('post_text')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();
        });

        $data = [];
        $data['points'] = [
            ['points_login', 1, 'Each login gives', 1, null, 'Points'],
            ['points_course_start', 1, 'Each course start gives', 25, null, 'Points'],
            ['points_course_completion', 1, 'Each course completion gives', 25, null, 'Points'],
            ['points_virtual_class', 1, 'Each virtual class enroll gives', 25, null, 'Points'],
            ['points_certificate', 1, 'Each certificate gives', 25, null, 'Points'],
            //['points_test', 1, 'Each successful test completion gives', 5, null, 'Points'],
            //['points_assignment', 1, 'Each successful assignment completion gives', 5, null, 'Points'],
            //['points_comment', 1, 'Each discussion topic or comment gives', 1, null, 'Points'],
        ];

        //$data['badges'] = [
        //    ['badge_', 0, 'Activity badges ( 4, 8, 16, 32, 64, 128, 256, 512 logins ) [Available For: Instructor, Student, Staff, Organization, Employer ]', null, null, null],
        //    ['badge_', 0, 'Registration badges ( 1, 7, 30, 60, 90, 120, 150, 365 Days ) [Available For: Instructor, Student, Staff, Organization, Employer ]', null, null, null],
        //    ['badge_', 0, 'Course count badges ( 1, 2, 4, 8, 16, 32, 64, 128 Courses ) [Available For: Instructor, Staff, Organization, Employer ]', null, null, null],
        //    ['badge_', 0, 'Course rating badges ( 1, 2, 4, 8, 16, 32, 64, 128 rating ) [Available For: Instructor, Staff, Organization, Employer ]', null, null, null],
        //    ['badge_', 0, 'Course sales badges ( 1, 2, 4, 8, 16, 32, 64, 128 Enrolled ) [Available For: Instructor, Staff, Organization, Employer ]', null, null, null],
        //    ['badge_', 0, 'Blog post badges ( 1, 2, 4, 8, 16, 32, 64, 128 Posts ) [Available For: Instructor, Staff, Organization, Employer ]', null, null, null],
        //    ['badge_', 0, 'Learning badges ( 1, 2, 4, 8, 16, 32, 64, 128 completed courses ) [Available For: Student ]', null, null, null],
        //    ['badge_', 0, 'Test badges ( 2, 4, 8, 16, 32, 64, 128, 256 passed tests ) [Available For: Student ]', null, null, null],
        //    ['badge_', 0, 'Assignment badges ( 1, 2, 4, 8, 16, 32, 64, 128 passed assignments ) [Available For: Student ]', null, null, null],
        //    ['badge_', 0, 'Perfectionism badges ( 1, 2, 4, 8, 16, 32, 64, 128 tests or assignments with score 90%+ ) [Available For: Student ]', null, null, null],
        //    ['badge_', 0, 'Survey badges ( 1, 2, 4, 8, 16, 32, 64, 128 completed surveys ) [Available For: Student ]', null, null, null],
        //    ['badge_', 0, 'Communication badges ( 2, 4, 8, 16, 32, 64, 128, 256 topics or comments ) [Available For: Student ]', null, null, null],
        //    ['badge_', 0, 'Certification badges ( 1, 2, 4, 8, 16, 32, 64, 128 certificates ) [Available For: Student ]', null, null, null],
        //];

        $data['levels'] = [
            ['levels_upgrade_points', 1, 'Upgrade level every', 3000, null, 'points'],
            ['levels_upgrade_courses', 1, 'Upgrade level every', 5, null, 'completed courses'],
            ['levels_upgrade_badges', 1, 'Upgrade level every', 5, null, 'badges'],
        ];

        $data['leaderboard'] = [
            ['leaderboard_show_levels', 0, 'Show Levels', null, null, null],
            ['leaderboard_show_points', 0, 'Show Points', null, null, null],
            ['leaderboard_show_badges', 0, 'Show Badges', null, null, null],
            ['leaderboard_show_courses', 0, 'Show Courses', null, null, null],
            ['leaderboard_show_certificates', 0, 'Show Certificates', null, null, null]
        ];

        foreach ($data as $group => $values) {
            $group = BadgeGroup::where('slug', '=', $group)->first();

            foreach ($values as $value) {
                $item = new BadgeSetting();
                $item->badge_group_id = $group->id;
                $item->name = $value[0];
                $item->input_count = $value[1];
                $item->pre_text = $value[2];
                $item->value = $value[3];
                $item->value_2 = $value[4];
                $item->post_text = $value[5];
                $item->active = 1;
                $item->save();
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
        Schema::dropIfExists('badge_settings');
    }
};
