<?php

use App\Models\Assessment;
use App\Models\AssessmentGroup;
use App\Models\AssessmentGroupMarking;
use App\Models\AssessmentStatement;

$data = [];

$data[] = [
    'statement' => 'SOCIABILITY SCALE',
    'items' => [
        ['I feel at ease around people', '+'],
        ['I prefer to be reserved with others', '-'],
        ['I like to meet and talk to different people', '+'],
        ['I don’t like to draw attention on me', '-'],
        ['I am usually the life of a party', '+'],
        ['I seldom talk to strangers', '-'],
    ]
];

$data[] = [
    'statement' => 'ALTRUISM SCALE',
    'items' => [
        ['I usually sympathise with others', '+'],
        ['I am not concerned about others', '-'],
        ['I always care for others', '+'],
        ['Other people’s problems annoy me', '-'],
        ['I make people feel comfortable around me', '+'],
        ['I think people should help themselves', '-'],
    ]
];

$data[] = [
    'statement' => 'RESPONSIBILITY/SENSE OF DUTY SCALE',
    'items' => [
        ['I care about the little details', '+'],
        ['I am very disorganised', '-'],
        ['I like to follow a schedule', '+'],
        ['I tend to forget my appointments', '-'],
        ['I make sure to do a thorough job / follow procedures', '+'],
        ['I like to find shortcuts and loopholes', '-'],
    ]
];

$data[] = [
    'statement' => 'STABILITY SCALE',
    'items' => [
        ['I am generally calm under pressure', '+'],
        ['I get frustrated for small things', '-'],
        ['I am usually in a good mood', '+'],
        ['I tend to worry about the future', '-'],
        ['I don’t easily get upset about things', '+'],
        ['I can be overwhelmed by negative emotions', '-'],
    ]
];

$data[] = [
    'statement' => 'CURIOSITY SCALE',
    'items' => [
        ['I have a great imagination', '+'],
        ['I prefer practical instructions', '-'],
        ['I always come up with new ideas', '+'],
        ['I am not interested in abstract and hypothetical talk', '-'],
        ['I easily pick up/actively look for new information', '+'],
        ['I don’t care to think about things that happened', '-'],
    ]
];

$assessment = new Assessment();
$assessment->name = 'Personality Assessment';
$assessment->description = fake()->words(10, true);
$assessment->save();

foreach ($data as $item) {
    $assessment_group = new AssessmentGroup();
    $assessment_group->assessment_id = $assessment->id;
    $assessment_group->name = $item['statement'];
    $assessment_group->save();

    foreach ($item['items'] as $statement) {
        $_statement = new AssessmentStatement();
        $_statement->assessment_id = $assessment->id;
        $_statement->assessment_group_id = $assessment_group->id;
        $_statement->statement = $statement[0];
        $_statement->scale = 5;
        $count = $statement[1] == '+' ? '-1' : '5';
        $_statement->scale_1 = abs($count);
        $_statement->scale_1_text = 'Very Inaccurate';
        $count--;
        $_statement->scale_2 = abs($count);
        $_statement->scale_2_text = 'Moderately Inaccurate';
        $count--;
        $_statement->scale_3 = abs($count);
        $_statement->scale_3_text = 'Neither Inaccurate nor Accurate';
        $count--;
        $_statement->scale_4 = abs($count);
        $_statement->scale_4_text = 'Moderately Accurate';
        $count--;
        $_statement->scale_5 = abs($count);
        $_statement->scale_5_text = 'Very Accurate';
        $count--;
        $_statement->save();
    }

    foreach ([[0, 10], [11, 20], [21, 30], [31, 40], [41, 50]] as $score) {
        $marking = new AssessmentGroupMarking();
        $marking->assessment_id = $assessment->id;
        $marking->assessment_group_id = $assessment_group->id;
        $marking->score_from = $score[0];
        $marking->score_to = $score[1];
        $marking->name = fake()->word(4, true);
        $marking->explanation = fake()->words(50, true);
        $marking->save();
    }
}
