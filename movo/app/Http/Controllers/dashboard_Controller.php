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
    // Show dashboard or tag selection view
    public function dashboardView()
    {        
        if (!session('geek_id')) {
            return redirect('/login');
        }

        $geek = geek::find(session('geek_id'));

        $given = userChoiceGiven::where('user_id', $geek->id)->count();

        if ($given == 0) {
            $tags = Tag::all();
            return view('selector', ['tags' => $tags]);
        }

        return view('dashboard');
    }

    // Handle genre choice submission
    public function genreChoice(Request $request)
    {
        $geek_id = session('geek_id');

        $this->validateTags($request);
        $this->saveUserTags($request->tags, $geek_id);
        $this->markUserChoiceGiven($geek_id);

        return redirect('/dashboard');
    }

    // Validate that tags are present in the request
    private function validateTags(Request $request)
    {
        $request->validate([
            'tags' => 'required'
        ]);
    }

    // Save the user's selected tags
    private function saveUserTags(array $tags, $geek_id)
    {
        foreach ($tags as $tag) {
            $userTag = new UserTag();
            $userTag->geek_id = $geek_id;
            $userTag->tag_id = $tag;
            $userTag->save();
        }
    }

    // Mark that the user has made their genre choice
    private function markUserChoiceGiven($geek_id)
    {
        $userGiven = new userChoiceGiven();
        $userGiven->user_id = $geek_id;
        $userGiven->save();
    }

    // Search for a movie and redirect to its detail page
    public function searchView(Request $request)
    {
        $this->validateMovieTitle($request);

        $movie = $this->findMovieInDatabase($request->movie);

        if ($movie) {
            return redirect('/movie/' . $movie->id);
        }

        $newMovie = $this->searchAndSaveMovieFromOMDB($request->movie);

        if ($newMovie) {
            return redirect('/movie/' . $newMovie->id);
        }

        return back()->withErrors(['movie' => 'Movie not found.']);
    }

    // Validate the presence of a movie title
    private function validateMovieTitle(Request $request)
    {
        $request->validate([
            'movie' => 'required'
        ]);
    }

    // Try to find the movie in the local database
    private function findMovieInDatabase($movieTitle)
    {
        return Movie::where('title', 'like', '%' . $movieTitle . '%')->first();
    }

    // Search for the movie in OMDB API and save it to the database if found
    private function searchAndSaveMovieFromOMDB($movieTitle)
    {
        $movieData = $this->fetchMovieFromOMDB($movieTitle);

        if (isset($movieData['Response']) && $movieData['Response'] == 'True') {
            $newMovie = $this->saveMovieData($movieData);
            $this->saveMovieGenres($newMovie->id, $movieData['Genre']);
            return $newMovie;
        }

        return null;
    }

    // Fetch movie data from the OMDB API
    private function fetchMovieFromOMDB($movieTitle)
    {
        $apiKey = env('OMDB_KEY');
        $title = urlencode($movieTitle);
        $url = "http://www.omdbapi.com/?apikey={$apiKey}&t={$title}";

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        return json_decode($response->getBody(), true);
    }

    // Save the movie data to the database
    private function saveMovieData(array $movieData)
    {
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

        return Movie::where('title', $movieData['Title'])->first();
    }

    // Save the movie genres (tags) into the database
    private function saveMovieGenres($movieId, $genreString)
    {
        $genres = explode(',', $genreString);

        foreach ($genres as $genre) {
            $genre = trim($genre);
            $tag = Tag::firstOrCreate(['name' => $genre]);

            $movieTag = new MovieTag();
            $movieTag->movie_id = $movieId;
            $movieTag->tag_id = $tag->id;
            $movieTag->save();
        }
    }
}
