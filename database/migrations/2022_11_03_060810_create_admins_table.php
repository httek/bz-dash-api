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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->boolean('type')->default(1)->index();
            $table->char('name', 60)->nullable();
            $table->string('avatar', 400)->nullable();
            $table->char('mobile', 15)->unique();
            $table->string('password', 200)->nullable();
            $table->boolean('status')->default(true)->index();
            $table->timestamp('login_at')->nullable();
            $table->unsignedBigInteger('role_id')->nullable()->index();
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
        Schema::dropIfExists('admins');
    }
};
