<?php

use App\Models\Assessment;
use App\Models\AssessmentGroup;
use App\Models\AssessmentGroupMarking;
use App\Models\AssessmentStatement;

$data = [];

$data[] = [
    'type' => 'Wellbeing',
    'statement' => 'At work, on which step of the ladder would you say you feel at this moment in time?',
    'label_a' => 'Worst Possible',
    'label_b' => 'Best Possible',
];

$data[] = [
    'statement' => 'On which step do you think you will stand in 5 years time when thinking about work?',
    'type' => 'Wellbeing',
    'label_a' => 'Worst Possible',
    'label_b' => 'Best Possible',
];

$data[] = [
    'statement' => 'Imagine the top of the ladder represents the best possible financial situation for you, and the bottom of the ladder represents the worst possible financial situation for you. Where on the ladder you stand right now with your current job?',
    'type' => 'Wellbeing',
    'label_a' => 'Worst Possible',
    'label_b' => 'Best Possible',
];

$data[] = [
    'statement' => 'In general, how would you rate work impact on your physical health?',
    'type' => 'Health',
    'label_a' => 'Poor',
    'label_b' => 'Excellent',
];

$data[] = [
    'statement' => 'How would you rate work impact on your overall mental wellbeing?',
    'type' => 'Health',
    'label_a' => 'Poor',
    'label_b' => 'Excellent',
];

$data[] = [
    'statement' => 'During the past six months, to what extent have you felt limited or overwhelmed by your workload?',
    'type' => 'Health',
    'label_a' => 'Not at all',
    'label_b' => 'Severely',
];

$data[] = [
    'statement' => 'My job gives me purpose and sense of direction',
    'type' => 'Wellbeing',
    'label_a' => 'Strongly Disagree',
    'label_b' => 'Strongly Agree',
];

$data[] = [
    'statement' => 'How often do you feel nobody can help you or understand you at work?',
    'type' => 'Wellbeing',
    'label_a' => 'Never',
    'label_b' => 'Always',
];

$data[] = [
    'statement' => 'How would you describe your sense of belonging to your workplace',
    'type' => 'Wellbeing',
    'label_a' => 'Very Weak',
    'label_b' => 'Very Strong',
];

$data[] = [
    'statement' => 'If you were in trouble, how confident would you feel about asking help to your colleagues or your manager?',
    'type' => 'Wellbeing',
    'label_a' => 'Not at all',
    'label_b' => 'Very Confident',
];

$data[] = [
    'statement' => 'In the past two weeks, how often have you experienced joy and/or gratitude while at work?',
    'type' => 'Wellbeing',
    'label_a' => 'Never',
    'label_b' => 'Always',
];

$data[] = [
    'statement' => 'During the past two weeks, how often have you experienced negative emotions such as sadness, worry, despair while at work?',
    'type' => 'Wellbeing',
    'label_a' => 'Never',
    'label_b' => 'Always',
];

$assessment = new Assessment();
$assessment->name = 'Wellbeing Assessment';
$assessment->description = fake()->words(10, true);
$assessment->save();

foreach ($data as $item) {
    $assessment_group = AssessmentGroup::where('name', '=', $item['type'])->where('assessment_id', '=', $assessment->id)->first();
    if (!$assessment_group) {
        $assessment_group = new AssessmentGroup();
        $assessment_group->assessment_id = $assessment->id;
        $assessment_group->name = $item['type'];
        $assessment_group->save();

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

    $_statement = new AssessmentStatement();
    $_statement->assessment_id = $assessment->id;
    $_statement->assessment_group_id = $assessment_group->id;
    $_statement->statement = $item['statement'];
    $_statement->scale = 10;
    $count = 10;
    $_statement->scale_1 = abs($count);
    $_statement->scale_1_text = 'Never';
    $count--;
    $_statement->scale_2 = abs($count);
    $_statement->scale_2_text = '';
    $count--;
    $_statement->scale_3 = abs($count);
    $_statement->scale_3_text = '';
    $count--;
    $_statement->scale_4 = abs($count);
    $_statement->scale_4_text = '';
    $count--;
    $_statement->scale_5 = abs($count);
    $_statement->scale_5_text = '';
    $count--;
    $_statement->scale_6 = abs($count);
    $_statement->scale_6_text = '';
    $count--;
    $_statement->scale_7 = abs($count);
    $_statement->scale_7_text = '';
    $count--;
    $_statement->scale_8 = abs($count);
    $_statement->scale_8_text = '';
    $count--;
    $_statement->scale_9 = abs($count);
    $_statement->scale_9_text = '';
    $count--;
    $_statement->scale_10 = abs($count);
    $_statement->scale_10_text = 'Always';
    $count--;
    $_statement->save();
}
