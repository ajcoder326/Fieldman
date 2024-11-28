<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->enum('field_type', ['text', 'number', 'date', 'time', 'boolean', 'select', 'multiselect', 'url', 'email', 'address']);
            $table->string('label');
            $table->string('placeholder')->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('min_length')->nullable();
            $table->integer('max_length')->nullable();
            $table->text('default_values')->nullable();
            $table->text('values')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
