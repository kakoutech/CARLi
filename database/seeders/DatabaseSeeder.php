<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BadgeLevel;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\MultipleChoiceQuestion;
use App\Models\MultipleChoiceQuestionSet;
use App\Models\User;
use App\Models\StrategyToolTopic;
use App\Models\UserBadge;
use App\Models\VirtualClass;
use App\Models\VirtualClassAttendee;
use App\Models\VirtualClassCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        require __DIR__ . '/PersonalityAssessmentSeeder.php';

        require __DIR__ . '/ResilienceAssessmentSeeder.php';

        require __DIR__ . '/WellbeingAssessmentSeeder.php';

        foreach (\App\Models\User::factory(1)->create() as $admin) {
            $admin->account_type = 'admin';
            $admin->trainer_id = null;
            $admin->employer_id = null;
            $admin->save();
        }

        foreach (\App\Models\User::factory(3)->create() as $employer) {
            $employer->account_type = 'employer';
            $employer->company_name = fake()->company();
            $employer->save();

            foreach (\App\Models\User::factory(10)->create() as $trainer) {
                $trainer->account_type = 'trainer';
                $trainer->employer_id = $employer->id;
                $trainer->save();

                foreach (\App\Models\User::factory(10)->create() as $learner) {
                    $learner->account_type = 'learner';
                    $learner->trainer_id = $trainer->id;
                    $learner->employer_id = $trainer->employer_id;
                    $learner->save();
                }
            }
        }


        foreach (['admin', 'employer', 'trainer', 'learner'] as $type) {
            $user = User::where('account_type', '=', $type)->first();
            $user->email = $type . '@example.com';
            $user->save();
        }

        \App\Models\Page::factory(50)->create();

        $page = \App\Models\Page::factory(1)->make();
        $page = $page[0];
        $page->path = 'terms-and-conditions';
        $page->name = 'Terms & Conditions';
        $page->active = 1;
        $page->save();

        $page = \App\Models\Page::factory(1)->make();
        $page = $page[0];
        $page->path = 'privacy';
        $page->name = 'Privacy Policy';
        $page->active = 1;
        $page->save();

        \App\Models\StrategyToolTopic::factory(5)->create();

        $articles = \App\Models\StrategyToolArticle::factory(30)->make();
        foreach ($articles as $article) {
            $article->strategy_tool_topic_id = (StrategyToolTopic::query()->inRandomOrder()->first())->id;
            $article->save();
        }

        \App\Models\CourseTopic::factory(10)->create();
        foreach (\App\Models\Course::factory(50)->make() as $course) {
            $course->save();
        }

        foreach (MultipleChoiceQuestionSet::factory(10)->create() as $set) {
            $question = (MultipleChoiceQuestion::factory(1)->create())[0];
            $question->addAnswer(fake()->words(rand(2, 7), true), 1);
            $question->addAnswer(fake()->words(rand(2, 7), true), 0);
            $question->addAnswer(fake()->words(rand(2, 7), true), 0);
            $question->addAnswer(fake()->words(rand(2, 7), true), 0);
            $set->addQuestion($question);
        }

        foreach (User::query()->learners()->get() as $learner) {
            $course = Course::query()->inRandomOrder()->first();

            $enroll = new CourseEnroll();
            $enroll->course_id = $course->id;
            $enroll->learner_id = $learner->id;
            $enroll->save();

            foreach (BadgeLevel::inRandomOrder()->limit(3)->get() as $badge_level) {
                $user_badge = new UserBadge();
                $user_badge->user_id = $learner->id;
                $user_badge->badge_id = $badge_level->badge_id;
                $user_badge->badge_level_id = $badge_level->id;
                $user_badge->save();
            }

            $trainers = User::query()->inRandomOrder()->limit(5)->get();
            foreach ($trainers as $trainer) {
                $conversation = $learner->startConversationWith($trainer);
                $conversation->addMessage($learner, fake()->words(rand(10, 80), true));
                $conversation->addMessage($trainer, fake()->words(rand(10, 80), true));
            }
        }

        VirtualClassCategory::factory(20)->create();

        foreach (VirtualClass::factory(50)->make() as $class) {

            $class->save();

            foreach (VirtualClassAttendee::factory(10)->make() as $attendee) {
                $user = User::query()->learners()->inRandomOrder()->first();
                $attendee->virtual_class_id = $class->id;
                $attendee->learner_id = $user->id;
                $attendee->save();
            }
            $class->save();
        }
    }
}
