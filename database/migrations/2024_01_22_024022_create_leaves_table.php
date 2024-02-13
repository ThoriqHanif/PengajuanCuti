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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration');
            $table->text('reason');
            $table->boolean('status_manager')->nullable();
            $table->boolean('status_coo')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('coo_id')->nullable();
            $table->date('date_manager')->nullable();
            $table->date('date_coo')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('coo_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
