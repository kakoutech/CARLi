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
        Schema::table('assessment_group_markings', function (Blueprint $table) {
            $table->string('post_explanation')->after('explanation')->nullable();
            $table->renameColumn('explanation', 'pre_explanation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment_group_markings', function (Blueprint $table) {
            $table->renameColumn('pre_explanation', 'explanation');
            $table->dropColumn('post_explanation');
        });
    }
};
