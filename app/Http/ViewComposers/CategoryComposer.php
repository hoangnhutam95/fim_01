<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryComposer
{
    /**
     * The user repository implementation.
     *
     * @var  CategoryRepositoryInterface
     */
    protected $categoryRepository;
    protected $songCategories;
    protected $albumCategories;

    /**
     * Create a new profile composer.
     *
     * @param    CategoryRepositoryInterface  $categoryRepository
     * @return  void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->songCategories = $this->categoryRepository->getSongCategories();
        $this->albumCategories = $this->categoryRepository->getalbumCategories();
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
            'songCategories' => $this->songCategories,
            'albumCategories' => $this->albumCategories,
        ]);
    }
}
