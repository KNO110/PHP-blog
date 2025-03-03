<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignUlid('post_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['post_id', 'tag_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
