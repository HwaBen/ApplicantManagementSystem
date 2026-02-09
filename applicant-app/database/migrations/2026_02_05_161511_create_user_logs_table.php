<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('performed_by'); // admin id
            $table->unsignedBigInteger('user_id'); // affected user
            $table->string('action'); // created / updated / deleted
            $table->timestamps();

            $table->foreign('performed_by')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('user_logs');
    }
};
