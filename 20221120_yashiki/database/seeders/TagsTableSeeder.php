<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category' => '家事',
        ];
        Tag::create($param);
        $param = [
            'category' => '勉強',
        ];
        Tag::create($param);
        $param = [
            'category' => '運動',
        ];
        Tag::create($param);
        $param = [
            'category' => '食事',
        ];
        Tag::create($param);
        $param = [
            'category' => '移動',
        ];
        Tag::create($param);
    }
}
