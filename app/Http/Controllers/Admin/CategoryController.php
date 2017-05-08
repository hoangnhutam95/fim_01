<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $category = $this->categoryRepository->create($request->all());
            if ($category) {
                return redirect()->route('category.index')->with([
                    'flash_level' => 'success',
                    'flash_message' => trans('admin.add-category-success'),
                ]);
            }
        } catch (Exception $e) {
            return redirect()->route('category.index')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('admin.add-category-fail'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        $categoryUpdated = $this->categoryRepository->update($request->all(), $id);
        if ($categoryUpdated) {
            return redirect()->route('category.index')->with([
                'flash_level' => 'success',
                'flash_message' => trans('admin.update-category-success'),
            ]);
        }
        return redirect()->route('category.index')->with([
            'flash_level' => 'warning',
            'flash_message' => trans('admin.update-category-fail'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->categoryRepository->delete($id);
        if ($deleted) {
            return redirect()->back()->with([
                'flash_level' => 'success',
                'flash_message' => trans('admin.delete-category-success'),
            ]);
        }

        return redirect()->back()->with([
            'flash_level' => 'warning',
            'flash_message' => trans('admin.delete-category-fail'),
        ]);
    }
}
