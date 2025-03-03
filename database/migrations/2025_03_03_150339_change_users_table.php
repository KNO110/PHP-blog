<?php

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->ulid('id')->primary()->first();
            $table->enum('role', Arr::map(UserRole::cases(), fn($role) => $role->value))
                ->default(UserRole::USER->value)
                ->after('password');
            $table->string('avatar', 2048)->nullable()->after('role');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropColumn('user_id');
            $table->foreignUlid('user_id')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->id();
            $table->dropColumn(['role', 'avatar']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropColumn('user_id');
            $table->foreignId('user_id')->nullable()->index();
        });
    }
};
