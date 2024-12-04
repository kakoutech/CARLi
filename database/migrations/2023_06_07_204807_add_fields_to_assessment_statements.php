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
        Schema::table('assessment_statements', function (Blueprint $table) {
            $table->string('scale_1_explanation')->nullable()->after('scale_1_text');
            $table->string('scale_2_explanation')->nullable()->after('scale_2_text');
            $table->string('scale_3_explanation')->nullable()->after('scale_3_text');
            $table->string('scale_4_explanation')->nullable()->after('scale_4_text');
            $table->string('scale_5_explanation')->nullable()->after('scale_5_text');
            $table->string('scale_6_explanation')->nullable()->after('scale_6_text');
            $table->string('scale_7_explanation')->nullable()->after('scale_7_text');
            $table->string('scale_8_explanation')->nullable()->after('scale_8_text');
            $table->string('scale_9_explanation')->nullable()->after('scale_9_text');
            $table->string('scale_10_explanation')->nullable()->after('scale_10_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment_statements', function (Blueprint $table) {
            $table->dropColumn('scale_1_explanation');
            $table->dropColumn('scale_2_explanation');
            $table->dropColumn('scale_3_explanation');
            $table->dropColumn('scale_4_explanation');
            $table->dropColumn('scale_5_explanation');
            $table->dropColumn('scale_6_explanation');
            $table->dropColumn('scale_7_explanation');
            $table->dropColumn('scale_8_explanation');
            $table->dropColumn('scale_9_explanation');
            $table->dropColumn('scale_10_explanation');
        });
    }
};
