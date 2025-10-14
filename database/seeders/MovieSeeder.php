<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use Illuminate\Support\Facades\Schema;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Movie::truncate();
        Schema::enableForeignKeyConstraints();

        $movies = [
            [
                'title' => 'Dune: Part Two',
                'description' => 'Paul Atreides unites with Chani and the Fremen while seeking revenge against those who destroyed his family. Facing a choice between the love of his life and the fate of the known universe, he endeavors to prevent a terrible future only he can foresee.',
                'release_date' => '2024-03-01',
                'image' => 'https://image.tmdb.org/t/p/w500/1pdfLvkbYGDYgc1f2h5tdlJLDqp.jpg',
                'duration' => 166,
                'trailer_url' => 'https://www.youtube.com/watch?v=U2Qp5pL3ovA',
                'is_trending' => true,
                'is_new' => true,
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Imprisoned in the 1940s for the double murder of his wife and her lover, upstanding banker Andy Dufresne begins a new life at the Shawshank prison, where he puts his accounting skills to work for an amoral warden.',
                'release_date' => '1994-09-23',
                'image' => 'https://image.tmdb.org/t/p/w500/9cqNxx0GxF0bflZmeSMuL5tnGzr.jpg',
                'duration' => 142,
                'trailer_url' => 'https://www.youtube.com/watch?v=6hB3S9bIaco',
                'is_trending' => false,
                'is_new' => false,
            ],
            [
                'title' => 'The Godfather',
                'description' => 'Spanning the years 1945 to 1955, a chronicle of the fictional Italian-American Corleone crime family. When organized crime family patriarch, Vito Corleone barely survives an attempt on his life, his youngest son, Michael steps in to take care of the would-be killers.',
                'release_date' => '1972-03-24',
                'image' => 'https://image.tmdb.org/t/p/w500/3bhkrj58Vtu7enYsRolD1fZdja1.jpg',
                'duration' => 175,
                'trailer_url' => 'https://www.youtube.com/watch?v=sY1S34973zA',
                'is_trending' => false,
                'is_new' => false,
            ],
            [
                'title' => 'Oppenheimer',
                'description' => 'The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.',
                'release_date' => '2023-07-21',
                'image' => 'https://image.tmdb.org/t/p/w500/ptM0QDc0sJbJd03g000000000000.jpg',
                'duration' => 180,
                'trailer_url' => 'https://www.youtube.com/watch?v=uYPbbksJxIg',
                'is_trending' => true,
                'is_new' => false,
            ],
        ];

        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }
    }
}
