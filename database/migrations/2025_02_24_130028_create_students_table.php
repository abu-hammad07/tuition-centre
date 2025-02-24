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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100);
            $table->string('email')->unique()->nullable();
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female']);
            $table->text('address')->nullable();
            $table->string('guardian_name', 255);
            $table->string('guardian_phone', 20);
            $table->string('class_name', 100);
            $table->date('admission_date');
            $table->enum('status', [0, 1])->default(0);
            $table->string('profile_photo')->nullable();
            $table->foreignId('is_deleted')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
