<?php

use App\Models\Assessment;
use App\Models\AssessmentGroup;
use App\Models\AssessmentGroupMarking;
use App\Models\AssessmentStatement;

$data = [];

$data[] = [
    'statement' => 'OPTIMISM',
    'items' => [
        ['I am not easily bothered by things that happen at work', '+'],
        ['I tend to fear for the worst when something goes wrong at work', '-'],
        ['I enjoy my work', '+'],
        ['I feel nothing will change no matter what I do', '-'],
        ['I maintain a calm and controlled attitude under pressure', '+'],
        ['I tend to get stuck thinking about my work problems', '-'],
    ]
];

$data[] = [
    'statement' => 'SOCIAL SUPPORT',
    'items' => [
        ['I feel understood by my colleagues', '+'],
        ['I don’t often trust others', '-'],
        ['I feel appreciated by my colleagues', '+'],
        ['I feel my colleagues don’t care about what happens to me', '-'],
        ['I often seek colleagues’ consult when making decisions', '+'],
        ['I don’t like to be given advice or support in my job', '-'],
    ]
];

$data[] = [
    'statement' => 'PURPOSE',
    'items' => [
        ['I hold myself accountable at work', '+'],
        ['I am often disinterested in my day to day practice', '-'],
        ['I am not easily distracted when I am with my clients', '+'],
        ['I can’t make up my mind about working decisions', '-'],
        ['I tend to go the extra mile in my practice', '+'],
        ['I rarely stick around in the same job', '-'],
    ]
];

$data[] = [
    'statement' => 'HUMOUR/PLAYFULNESS',
    'items' => [
        ['I use laughter to bring joy to the people I support and my team', '+'],
        ['I seldom joke with my colleagues', '-'],
        ['I try to enjoy all kinds of situations at work', '+'],
        ['I am not known for my sense of humour by my colleagues', '-'],
        ['Work is more of a playground than a battelfield', '+'],
        ['My colleagues say I am not fun to be around', '-'],
    ]
];

$assessment = new Assessment();
$assessment->name = 'Resilience Assessment';
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
        $count--;
        $_statement->scale_2 = abs($count);
        $count--;
        $_statement->scale_3 = abs($count);
        $count--;
        $_statement->scale_4 = abs($count);
        $count--;
        $_statement->scale_5 = abs($count);
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
