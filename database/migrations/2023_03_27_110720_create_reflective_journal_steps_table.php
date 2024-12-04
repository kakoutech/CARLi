<?php

use App\Models\ReflectiveJournalStep;
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
        Schema::create('reflective_journal_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('order')->nullable();
            $table->longtext('content')->nullable();
            $table->boolean('accept_input')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();
        });

        $data = [];
        $data['What happened?'] = ['Provide a brief description of the situation.'];
        $data['Experience of the Person'] = ['What was the person thinking/expecting?', 'Did I uphold the person’s identity?', 'Are there physical conditions impacting on the person’s communication/behaviour?', 'Are there mental health factors impacting on the person’s communication/behaviour?', 'How did the way I responded to them make them feel?'];
        $data['My experience'] = ['How do I feel?',  'Was I authentic within the interaction?', 'What influenced the way I feel?', 'How could I improve the way I feel in this situation?', 'Did I consider cultural wishes?'];
        $data['Environment'] = ['Was the environment orientating (have a clear purpose for function)?', 'Were relevant objects in reach?', 'Was the environment clearly legible?', 'Was the environment familiar?', 'Was the environment stimulating?', 'Were there any risks in the environment?', 'If using assistive technology, did I support the use of it effectively?', 'Did I minimise the use of restraint?'];
        $data['Enablement'] = ['Did I get the person opportunity to be as independent as possible?' , 'Could I have given the person more control?', 'Am I aware of the person’s strengths?', 'Did I give the person the opportunity to use their strengths?', 'Was the pace of support appropriate?'];
        $data['Safety'] = ['Did I make the person feel safe?', 'Am I aware of the things the person worried about?', 'Were there any potential risks?' ,'Was I able to comply with the risk assessment?'];
        $data['Learning'] = ['What did I learn here?', 'What was my professional responsibility in this situation?', 'What will I do differently?'];
        $data['Organisational Memory'] = ['What do I need to share with my organisation?'];

        $count = 1;
        foreach ($data as $key => $values) {
            $item = new ReflectiveJournalStep();
            $item->title = $key;
            $item->content = '<p>' . implode('</p><p>', $values) . '</p>';
            $item->order = $count;
            $item->save();

            $count++;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reflective_journal_steps');
    }
};
