<?php

namespace App\Repositories\Singer;

use Auth;
use App\Models\Singer;
use App\Repositories\BaseRepository;
use Exception;

class SingerRepository extends BaseRepository implements SingerRepositoryInterface
{
    public function __construct(Singer $singer)
    {
        $this->model = $singer;
    }

    public function getListSingers()
    {
        return $this->model->pluck('name', 'id');
    }
}
