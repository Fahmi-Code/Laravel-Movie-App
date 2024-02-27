<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $genresArray;
   

    public function __construct( $genresArray, $movie){
        $this->genresArray=$genresArray;

         $this->movie=$movie;
    }
    public function genresArray()
{
   return  $this->genresArray;
}
public function movie(){
    return collect( $this->movie)->merge(
        [
            'backdrop_path' => "https://image.tmdb.org/t/p/w220_and_h330_face{$this->movie['backdrop_path']}",
                'vote_average' => $this->movie['vote_average'] * 10 .'%',
                'release_date' => \Carbon\Carbon::parse($this->movie['release_date'])->format('d M, Y') ,
                'genres'=>collect ($this->movie['genres'])->pluck('name')->flatten()->implode(", "),
                'crew' => collect($this->movie['credits']['crew'])->take(2),
                'cast' => collect($this->movie['credits']['cast'])->take(5),
                'images' => collect($this->movie['images']['backdrops'])->take(9),


                
        ]

        )->only(
            'backdrop_path',
            'id','title','overview','credits','videos',
                'vote_average',
                'release_date' ,
                'genres',
                'crew',
                'cast',
                'images' ,
        );
   
}

}
