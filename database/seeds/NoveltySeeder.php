<?php

use Illuminate\Database\Seeder;
use App\Models\Nolvelty;

class NoveltySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $novelty = file_get_contents(database_path() . "/scripts/novelty.sql");
        $statements = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $novelty)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }

}
