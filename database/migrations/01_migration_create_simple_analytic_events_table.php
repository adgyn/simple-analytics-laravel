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
        Schema::create('simple_analytic_events', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('event_name');
            $table->string('event_label')->index();
            $table->string('route')->nullable()->index();
            $table->string('reference')->nullable()->index();
            $table->string('country')->nullable()->index();
            $table->string('country_code')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simple_analytic_events');
    }
};
