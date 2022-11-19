<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'title' => 'テスト',
            'tag_id' => '1',
            'user_id' => '1',
        ];
        Todo::create($param);
    }
}
