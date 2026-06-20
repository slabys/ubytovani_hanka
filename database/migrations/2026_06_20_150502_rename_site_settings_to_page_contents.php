<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('site_settings', 'page_contents');
    }

    public function down(): void
    {
        Schema::rename('page_contents', 'site_settings');
    }
};
