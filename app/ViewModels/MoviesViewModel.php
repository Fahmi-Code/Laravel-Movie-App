<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $nowPlayingMovies, $genresArray ;

    public function __construct($popularMovies, $nowPlayingMovies, $genresArray)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genresArray = $genresArray;
    }

    public function popularMovies()
{
   return  $this->formatMovies($this->popularMovies);
}

    public function nowPlayingMovies()
{
   return  $this->formatMovies($this->nowPlayingMovies);
}

    private function formatMovies($movies) 
    {
       
        return collect($movies)->map(function ($movie) {
            $genreFormated=collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genresArray()->get($value)];
                    })->implode(', ');

            return collect($movie)->merge([
                'backdrop_path' => "https://image.tmdb.org/t/p/w220_and_h330_face{$movie['backdrop_path']}",
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('d M, Y') ,
                'genres' => $genreFormated,
            ])->only(
                [
                   'id', 'backdrop_path' ,'vote_average' , 'release_date' ,'genres','genre_ids','title','overview' 
                ]
            );
        });
    }

    public function genresArray()
    {
        
        return   collect($this->genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

}
