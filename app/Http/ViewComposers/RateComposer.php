<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Album\AlbumRepositoryInterface;

class RateComposer
{
    /**
     * The user repository implementation.
     *
     * @var  SongRepositoryInterface
     */
    protected $songRepository;
    protected $albumRepository;
    protected $topRateAudios;
    protected $topRateVideos;
    protected $topRateAlbums;

    /**
     * Create a new profile composer.
     *
     * @param    SongRepositoryInterface  $songRepository
     * @return  void
     */
    public function __construct(SongRepositoryInterface $songRepository, AlbumRepositoryInterface $albumRepository)
    {
        $this->songRepository = $songRepository;
        $this->albumRepository = $albumRepository;
        $this->topRateAudios = $this->songRepository->getTopRateAudio()->paginate(config('settings.rate_count'));
        $this->topRateVideos = $this->songRepository->getTopRateVideo()->paginate(config('settings.rate_count'));
        $this->topRateAlbums = $this->albumRepository->getTopRateAlbum()->paginate(config('settings.rate_cout'));
    }

    /**
     * Bind data to the view.
     *
     * @param    View  $view
     * @return  void
     */
    public function compose(View $view)
    {
        $view->with([
            'topRateAudios' => $this->topRateAudios,
            'topRateVideos' => $this->topRateVideos,
            'topRateAlbums' => $this->topRateAlbums,
        ]);
    }
}
