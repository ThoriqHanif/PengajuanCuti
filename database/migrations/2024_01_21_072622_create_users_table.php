<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100);
            $table->string('username', 50)->unique();
            $table->string('telp', 13);
            $table->text('address')->nullable();
            $table->date('entry_date');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('coo_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('coo_id')->references('id')->on('users');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
