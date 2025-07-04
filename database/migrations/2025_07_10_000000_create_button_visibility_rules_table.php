<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('button_visibility_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('role_id');
            $table->string('button_type'); // assign, reassign, revert
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unique(['status_id', 'role_id', 'button_type'], 'unique_button_visibility');
        });
    }

    public function down()
    {
        Schema::dropIfExists('button_visibility_rules');
    }
}; 