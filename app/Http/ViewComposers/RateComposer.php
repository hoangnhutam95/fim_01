<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Album\AlbumRepositoryInterface;
use App\Repositories\View\ViewRepositoryInterface;

class RateComposer
{
    /**
     * The user repository implementation.
     *
     * @var  SongRepositoryInterface
     */
    protected $songRepository;
    protected $albumRepository;
    protected $viewRepository;
    protected $topRateAudios;
    protected $topRateVideos;
    protected $topRateAlbumAudios;
    protected $topViewAllAudios;
    protected $topViewWeekAudios;
    protected $topViewMonthAudios;
    protected $topViewAllVideos;
    protected $topViewWeekVideos;
    protected $topViewMonthVideos;

    /**
     * Create a new profile composer.
     *
     * @param    SongRepositoryInterface  $songRepository
     * @return  void
     */
    public function __construct(
        SongRepositoryInterface $songRepository,
        AlbumRepositoryInterface $albumRepository,
        ViewRepositoryInterface $viewRepository
    ) {
        $this->songRepository = $songRepository;
        $this->albumRepository = $albumRepository;
        $this->viewRepository = $viewRepository;
        $this->topRateAudios = $this->songRepository->getTopRateAudio()->paginate(config('settings.rate_count'));
        $this->topRateVideos = $this->songRepository->getTopRateVideo()->paginate(config('settings.rate_count'));
        $this->topRateAlbums = $this->albumRepository->getTopRateAlbum()->paginate(config('settings.rate_cout'));
        $this->topViewAllAudios = $this->viewRepository->getTopViewAllAudio()->paginate(config('settings.rate_count'));
        $this->topViewWeekAudios = $this->viewRepository
            ->getTopViewWeekAudio()
            ->paginate(config('settings.rate_count'));
        $this->topViewMonthAudios = $this->viewRepository
            ->getTopViewMonthAudio()
            ->paginate(config('settings.rate_cout'));
        $this->topViewAllVideos = $this->viewRepository
            ->getTopViewAllVideo()->paginate(config('settings.rate_count'));
        $this->topViewWeekVideos = $this->viewRepository
            ->getTopViewWeekVideo()
            ->paginate(config('settings.rate_count'));
        $this->topViewMonthVideos = $this->viewRepository
            ->getTopViewMonthVideo()
            ->paginate(config('settings.rate_cout'));
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
            'topViewAllAudios' => $this->topViewAllAudios,
            'topViewWeekAudios' => $this->topViewWeekAudios,
            'topViewMonthAudios' => $this->topViewMonthAudios,
            'topViewAllVideos' => $this->topViewAllVideos,
            'topViewWeekVideos' => $this->topViewWeekVideos,
            'topViewMonthVideos' => $this->topViewMonthVideos,
        ]);
    }
}
