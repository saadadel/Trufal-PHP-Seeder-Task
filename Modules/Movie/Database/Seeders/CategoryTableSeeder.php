<?php

namespace Modules\Movie\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Modules\Movie\Entities\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $client = new Client();
        $response = $client->get('https://api.themoviedb.org/3/genre/movie/list', [
            'query' => [
                'api_key' => '7b14a04d7d43a9bfb87bb698c77622af'
            ]
        ]);
        $body = json_decode((string) $response->getBody(), true);
        // dd($body);

        Category::insert($body['genres']);
    }
}
