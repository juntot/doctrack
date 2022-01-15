<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->string('docId', 255)->unique();
            $table->text('base64')->nullable();
            $table->longtext('history')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->dateTime('datesubmitted')->useCurrent();
            $table->text('remarks')->default('user'); // user, admin, staff
            $table->boolean('status')->default(0);
            $table->tinytext('docstat')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('docs');
    }
}
