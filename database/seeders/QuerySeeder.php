<?php

namespace Database\Seeders;

use App\Models\Query;
use Illuminate\Database\Seeder;

class QuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query = [
            ['name_query' => 'created'],
            ['name_query' => 'updated'],
            ['name_query' => 'deleted'],
            ['name_query' => 'login'],
            ['name_query' => 'logout'],
        ];
        foreach ($query as $dataquery) {
            Query::create($dataquery);
        }
    }
}
