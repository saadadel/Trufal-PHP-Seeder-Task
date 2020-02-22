<?php

namespace Modules\Movie\Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Movie\Entities\Movie;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $num_of_records = config('movie.num_of_records');

        Movie::truncate();

        $this->seedMovieFromAPI('top_rated', $num_of_records);
        $this->seedMovieFromAPI('now_playing', $num_of_records);

    }

    private function seedMovieFromAPI($movies_type, $num_of_records)
    {
        $client = new Client();

        $page_requests = ceil($num_of_records / 20);

        for ($i = 1; $i <= $page_requests; $i++)
        {
            $response = $client->get('https://api.themoviedb.org/3/movie/'. $movies_type.'', [
                'query' => [
                    'api_key' => '7b14a04d7d43a9bfb87bb698c77622af',
                    'page' => $i
                ]
            ]);
            $body = json_decode((string) $response->getBody(), true)['results'];

            // for last round save only the remaining number of records not all of the page
            if ($i == $page_requests) 
            {
                $remaining_records = $num_of_records % 20;
                $body = array_slice($body, 0, $remaining_records);
            }

            // Convert genre array to string 
            // add movie_type field
            foreach ($body as $key => $value) 
            {
                $body[$key]['genre_ids'] = implode(',', $body[$key]['genre_ids']);
                $body[$key]['movie_type'] = $movies_type;
                unset($body[$key]['id']);
            }

            Movie::insert($body);
        }
    }
}
