<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('examination_period');
            $table->string('status');
            $table->timestamps();
        });

        DB::table('exams_options')->insert(
        array(
            'examination_period' => 'none',
            'status' => 'Inactive'
        )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_options');
    }
}
