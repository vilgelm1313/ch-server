<?php

namespace App\Repositories\TvShow;

use App\Events\Model\ModelUpdated;
use App\Models\BaseModel;
use App\Models\TvShow\TvShow;
use App\Models\TvShow\TvShowSeason;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\SyncServers;
use Illuminate\Support\Facades\Storage;

class TvShowSeasonRepository extends BaseRepository
{
    use SyncServers;

    protected function getClass(): string
    {
        return TvShowSeason::class;
    }

    public function addSeason(int $tvShowId, string $name): TvShowSeason
    {
        $show = TvShow::find($tvShowId);
        $season = new TvShowSeason();
        $season->title = $name;
        $show->seasons()->save($season);

        return $season;
    }

    public function destroy(int $id): bool
    {
        $season = TvShowSeason::findOrFail($id);
        $deleted = parent::destroy($id);

        if ($deleted) {
            foreach($season->episodes as $episode) {
                Storage::disk('ftp')->delete($episode['path']);
            }
        }

        return $deleted;
    }

    public function update(int $id, array $data): BaseModel
    {
        $model = $this->show($id);
        $episodes = $model->episodes;
        $oldPathes = [];
        if ($episodes) {
            foreach ($episodes as $episode) {
                $oldPathes[] = $episode['path'];
            }
        }
        $model = parent::update($id, $data);

        $newEpisodes = $model->episodes;
        $newPathes = [];
        if ($newEpisodes) {
            foreach ($newEpisodes as $episode) {
                $newPathes[] = $episode['path'];
            }
        }

        foreach ($oldPathes as $path) {
            if (!in_array($path, $newPathes)) {
                Storage::disk('ftp')->delete($path);
            }
        }
        return $model;
    }

    public function view(int $showId)
    {
        return TvShow::findOrFail($showId)->seasons;
    }
}