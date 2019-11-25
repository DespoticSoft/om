<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();

            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('stuff_id')->nullable();

            $table->string('role')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('messenger')->nullable();
            $table->string('nid')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('bank_ac')->nullable();
            $table->text('address')->nullable();
            $table->date('dob')->nullable();

            $table->text('bio')->nullable();

            $table->bigInteger('registered_by')->unsigned()->index()->nullable();
            $table->foreign('registered_by')->references('id')->on('users');

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
        Schema::dropIfExists('users');
    }
}
