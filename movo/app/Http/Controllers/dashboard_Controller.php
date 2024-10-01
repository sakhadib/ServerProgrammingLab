<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\geek;
use App\Models\Tag;
use App\Models\userChoiceGiven;
use App\Models\UserTag;
use App\Models\Movie;
use App\Models\MovieTag;

class dashboard_Controller extends Controller
{
    public function dashboardView(){

        if(!session()->has('geek')){
            return redirect('/login');
        }

        $geek = geek::where('id', session('geek_id'))->first();

        $given = userChoiceGiven::where('user_id', $geek->id)->get();

        if($given->count() == 0){
            $tags = Tag::all();
            return view('selector', ['tags' => $tags]);
        }

        return view('dashboard');
    }

    public function genreChoice(Request $request){
        $geek_id = session('geek_id');

        $request->validate([
            'tags' => 'required'
        ]);

        foreach($request->tags as $tag){
            $userTag = new UserTag();
            $userTag->geek_id = $geek_id;
            $userTag->tag_id = $tag;
            $userTag->save();
        }

        $userGiven = new userChoiceGiven();
        $userGiven->user_id = $geek_id;
        $userGiven->save();

        return redirect('/dashboard');
    }

    public function searchView(Request $request)
{
    // Validate that the movie title is provided
    $request->validate([
        'movie' => 'required'
    ]);

    // Search for the movie in the database
    $movie = Movie::where('title', 'like', '%'.$request->movie.'%')->first();

    // If movie is found in the database, return it along with relevant tags
    if ($movie) {
        $tags = $movie->tags->pluck('name')->toArray(); // Fetch associated tags as an array of names
        return view('movie', ['movie' => $movie, 'tags' => $tags]);
    }

    // If movie is not found, call the OMDB API
    $apiKey = env('OMDB_KEY');
    $title = urlencode($request->movie); // URL encode the title to make it safe for URL
    $url = "http://www.omdbapi.com/?apikey={$apiKey}&t={$title}";

    // Send the API request
    $client = new \GuzzleHttp\Client(); // Guzzle HTTP client
    $response = $client->get($url);
    $movieData = json_decode($response->getBody(), true); // Parse JSON response

    // If API response is valid and contains movie data
    if (isset($movieData['Response']) && $movieData['Response'] == 'True') {

        // Save the movie data to the database
        $newMovie = new Movie();
        $newMovie->title = $movieData['Title'];
        $newMovie->year = $movieData['Year'];
        $newMovie->rated = $movieData['Rated'];
        $newMovie->released = $movieData['Released'];
        $newMovie->runtime = $movieData['Runtime'];
        $newMovie->director = $movieData['Director'];
        $newMovie->language = $movieData['Language'];
        $newMovie->country = $movieData['Country'];
        $newMovie->poster = $movieData['Poster'];
        $newMovie->type = $movieData['Type'];
        $newMovie->save();

        // After saving the movie, we now have the movie ID
        $movieId = $newMovie->id;

        // Process the Genre string, splitting it by commas
        $genres = explode(',', $movieData['Genre']); // Split genre by commas

        foreach ($genres as $genre) {
            $genre = trim($genre); // Remove any extra spaces

            // Check if the genre (tag) already exists in the tags table
            $tag = Tag::where('name', $genre)->first();

            if (!$tag) {
                // If the genre doesn't exist, create a new tag
                $tag = new Tag();
                $tag->name = $genre;
                $tag->save();
            }

            // Now insert the movie_id and tag_id into the movie_tag table using the MovieTag model
            $movieTag = new MovieTag();
            $movieTag->movie_id = $movieId;
            $movieTag->tag_id = $tag->id;
            $movieTag->save();
        }

        // Fetch the relevant tags
        $tags = $newMovie->tags->pluck('name')->toArray();

        // Return the saved movie data along with tags to the view
        return view('movie', ['movie' => $newMovie, 'tags' => $tags]);
    }

    // If no movie is found in the API, return an error or a message
    return back()->withErrors(['movie' => 'Movie not found.']);
}

    

}
