<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->text('author');
            $table->text('repo');
            $table->decimal('code');
            $table->decimal('complexity');
            $table->decimal('architecture');
            $table->decimal('style');
            $table->decimal('security_issues');
            $table->timestamps();

            $table->unique(['author','repo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badges');
    }
}
