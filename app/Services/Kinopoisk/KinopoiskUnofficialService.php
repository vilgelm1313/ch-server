<?php

namespace App\Services\Kinopoisk;

use App\Repositories\Settings\ConfigurationRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class KinopoiskUnofficialService
{
    protected ?string $apiKey;
    protected string $baseUrl = 'https://kinopoiskapiunofficial.tech/api/';

    public function __construct(protected ConfigurationRepository $configurationRepository)
    {
        $this->apiKey = $configurationRepository->getValueByKey('kinopoisk_api_key');
    }

    public function getMovieInfo(string $url): array
    {
        $url = trim($url, '/');
        $id = Str::afterLast($url, '/');

        $movie = $this->request('v2.2/films/' . $id);
        $staff = $this->request('v1/staff?filmId=' . $id);

        $countries = array_map(fn ($c) => $c['country'], $movie['countries']);
        $genres = array_map(fn ($c) => $c['genre'], $movie['genres']);

        $director = [];
        $actors = [];
        foreach ($staff as $staffMember) {
            if ($staffMember['professionKey'] === 'DIRECTOR') {
                $director[] = $staffMember['nameRu'];
            } elseif ($staffMember['professionKey'] === 'ACTOR') {
                $actors[] = $staffMember['nameRu'];
            }
        }

        return [
            'title' => $movie['nameRu'],
            'original_title' => $movie['nameOriginal'],
            'imbd' => $movie['ratingImdb'],
            'kinopoisk' => $movie['ratingKinopoisk'],
            'year' => '' . $movie['year'],
            'poster' => $movie['posterUrlPreview'],
            'description' => $movie['description'],
            'country' => implode(', ', $countries),
            'director' => implode(', ', $director),
            'actors' => implode(', ', $actors),
            'genres' => implode(', ', $genres),
        ];
    }

    protected function request(string $url)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])
            ->asJson()
            ->get($this->baseUrl . $url);
        if ($response->status() !== 200) {
            throw ValidationException::withMessages([
                'kinopoisk_url' => $response->reason(),
            ]);
        }

        return json_decode($response->body(), true);
    }
}
