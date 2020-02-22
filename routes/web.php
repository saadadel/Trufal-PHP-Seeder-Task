<?php

use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $num_of_records = config('movie.num_of_records');
    $page_requests = ceil($num_of_records / 20);

    // Movie::truncate();

    $client = new Client();
    for ($i = 1; $i <= $page_requests; $i++) {
        $response = $client->get('https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => '7b14a04d7d43a9bfb87bb698c77622af',
                'page' => $i
            ]
        ]);
        $body = json_decode((string) $response->getBody(), true)['results'];
        foreach ($body as $key => $value) {
            $body[$key]['genre_ids'] = implode(',', $body[$key]['genre_ids']);
            dd($body[$key]['genre_ids']);
        }
        dd($body);

        // for last round save only the remaining number of records not all of the page
        if ($i == $page_requests) {
            $remaining_records = $num_of_records % 20;
            $body = array_slice($body, 0, $remaining_records);
        }

        // Movie::insert($body);
    }
    return view('welcome');
});
