<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('users_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('method');
            $table->longText('activity');
            $table->ipAddress('ipAddress');
            $table->timestamps();
            // Keys //
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};
