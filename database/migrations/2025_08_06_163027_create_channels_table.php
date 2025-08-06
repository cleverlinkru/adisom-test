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
        Schema::create('channels', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->string('category');
            $table->integer('subscribers_count');
            $table->integer('average_views');
            $table->float('engagement_rate', 2, 2);
            $table->string('language');
            $table->string('region');
            $table->datetime('last_video_published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
