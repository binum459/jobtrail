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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('company_name');
             $table->string('job_role');
            $table->string('location')->nullable();
             $table->string('salary')->nullable();
            $table->string('job_source')->nullable();
            $table->string('job_url')->nullable();
             $table->date('applied_on')->nullable();
             $table->string('status')->default('wishlist');
             $table->unsignedInteger('position')->default(0);
              $table->text('notes')->nullable();
               $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
