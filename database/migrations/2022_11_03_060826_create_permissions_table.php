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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 400)->nullable();
            $table->string('path', 400)->nullable();
            $table->char('name', 60)->nullable();
            $table->char('title', 60)->nullable();
            $table->boolean('button')->default(false)->index();
            $table->unsignedBigInteger('parent')->nullable()->index();
            $table->unsignedInteger('sequence')->nullable();
            $table->char('relations', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
