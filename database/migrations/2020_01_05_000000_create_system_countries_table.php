<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('system_countries', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('symbol');
            $table->integer('code');
            $table->timestamps();
        });
    }
};
