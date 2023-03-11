<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table
                ->foreign('direct_boss_id')
                ->references('id')
                ->on('direct_bosses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('supervisor_committee_id')
                ->references('id')
                ->on('supervisor_committees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('technical_committee_id')
                ->references('id')
                ->on('technical_committees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('award_id')
                ->references('id')
                ->on('awards')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['direct_boss_id']);
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['supervisor_committee_id']);
            $table->dropForeign(['technical_committee_id']);
            $table->dropForeign(['award_id']);
        });
    }
};
