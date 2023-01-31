<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('email')->nullable()->unique();
            $table->longText('password')->nullable();
            $table->longText('name');
            $table->longText('phoneNumber')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->uuid('activationKey')->nullable()->unique();
            $table->uuid('forgottenPasswordKey')->nullable()->unique();
            $table->rememberToken();
            $table->timestamps();
            // Keys //
            $table->foreign('country_id')->references('id')->on('system_countries')->onUpdate('cascade')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 10001;");
    }
};
