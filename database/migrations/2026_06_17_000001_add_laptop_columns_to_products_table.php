<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('series')->nullable()->after('name');
            $table->string('processor')->nullable()->after('series');
            $table->string('processor_type')->nullable()->after('processor');
            $table->string('generation')->nullable()->after('processor_type');
            $table->string('ram')->nullable()->after('generation');
            $table->string('ram_type')->nullable()->after('ram');
            $table->string('storage')->nullable()->after('ram_type');
            $table->string('graphical_memory')->nullable()->after('storage');
            $table->string('screen_size')->nullable()->after('graphical_memory');
            $table->string('color')->nullable()->after('screen_size');
            $table->boolean('backlight')->nullable()->after('color');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'series', 'processor', 'processor_type', 'generation',
                'ram', 'ram_type', 'storage', 'graphical_memory',
                'screen_size', 'color', 'backlight',
            ]);
        });
    }
};
