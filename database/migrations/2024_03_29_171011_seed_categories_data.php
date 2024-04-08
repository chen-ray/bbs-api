<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            [
                'name'        => 'share',
                'description' => 'Share creation, share discovery',
            ],
            [
                'name'        => 'Tutorial',
                'description' => 'Development tips, recommended expansion packs, etc.',
            ],
            [
                'name'        => 'Q&A',
                'description' => 'Please be kind and help each other',
            ],
            [
                'name'        => 'announcement',
                'description' => 'Site Announcement',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
