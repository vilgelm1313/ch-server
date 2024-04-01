<?php

namespace App\Repositories\TvShow;

use App\Models\BaseModel;
use App\Models\TvShow\TvShow;
use App\Models\TvShow\TvShowSeason;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\SyncServers;
use Illuminate\Support\Facades\Storage;

class TvShowRepository extends BaseRepository
{
    use SyncServers;

    protected function getClass(): string
    {
        return TvShow::class;
    }

    protected function getWith(): array
    {
        return [
            'seasons',
            'servers'
        ];
    }

    protected function afterSave(BaseModel $model, array $data): BaseModel
    {
        return $this->syncServers($model, $data);
    }

    public function all()
    {
        return $this->getQuery()
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
    }

    public function destroy(int $id): bool
    {
        $show = TvShow::findOrFail($id);
        $show->load('seasons');
        $deleted = parent::destroy($id);

        if ($deleted) {
            /**
             * @var TvShowSeason $season
             */
            foreach($show->seasons as $season) {
                if ($season->episodes) {
                    foreach($season->episodes as $episode) {
                        Storage::disk('ftp')->delete($episode['path']);
                    }
                }
            }
        }

        return $deleted;
    }
}
