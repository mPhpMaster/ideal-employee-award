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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('direct_boss_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('supervisor_committee_id');
            $table->unsignedBigInteger('technical_committee_id');
            $table->unsignedBigInteger('award_id');
            $table
                ->unsignedBigInteger('rank')
                ->default(0)
                ->nullable();
            $table
                ->unsignedInteger('direct_boss_points')
                ->default(0)
                ->nullable();
            $table
                ->unsignedInteger('supervisor_committee_points')
                ->default(0)
                ->nullable();
            $table
                ->unsignedInteger('technical_committee_points')
                ->default(0)
                ->nullable();
            $table
                ->unsignedBigInteger('employee_points')
                ->default(0)
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
