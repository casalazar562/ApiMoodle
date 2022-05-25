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
        Schema::create('grade_grades', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('shortname')->nullable();
            $table->string('name')->nullable();
            $table->string('itemname')->nullable();
            // -------
            $table->bigInteger('itemid')->nullable();
            $table->bigInteger('userid')->nullable();
            $table->decimal('rawgrade')->nullable();
            $table->decimal('rawgrademax')->nullable();
            $table->decimal('rawgrademin')->nullable();
            $table->bigInteger('rawscaleid')->nullable();
            $table->bigInteger('usermodified')->nullable();
            $table->decimal('finalgrade')->nullable();
            $table->bigInteger('hidden')->nullable();
            $table->bigInteger('locked')->nullable();
            $table->bigInteger('locktime')->nullable();
            $table->bigInteger('exported')->nullable();
            $table->bigInteger('overridden')->nullable();
            $table->bigInteger('excluded')->nullable();
            $table->longText('feedback')->nullable();
            $table->bigInteger('feedbackformat')->nullable();
            $table->longText('information')->nullable();
            $table->bigInteger('informationformat')->nullable();
            $table->bigInteger('timecreated')->nullable();
            $table->bigInteger('timemodified')->nullable();
            $table->char('aggregationstatus')->nullable();
            $table->decimal('aggregationweight')->nullable();
            // -----------
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('email')->nullable();
            $table->string('institution')->nullable();
            $table->string('department')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_grades');
    }
};
