<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\View\ViewRepositoryInterface;

class ViewController extends Controller
{
    protected $viewRepository;

    public function __construct(ViewRepositoryInterface $viewRepository)
    {
        $this->viewRepository = $viewRepository;
    }

    public function index() {
        return view('admin.view.index');
    }

    public function resetWeekView(Request $request)
    {
        $view = $this->viewRepository->resetWeekView();
        if (!$view) {
            return redirect()->action('Admin\ViewController@index')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('admin.reset-fail'),
            ]);
        }

        return redirect()->action('Admin\ViewController@index')->with([
            'flash_level' => 'success',
            'flash_message' => trans('admin.reset_reset-success'),
        ]);
    }

    public function resetMonthView(Request $request)
    {
        $view = $this->viewRepository->resetMonthView();

        if (!$view) {
            return redirect()->action('Admin\ViewController@index')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('admin.reset-fail'),
            ]);
        }

        return redirect()->action('Admin\ViewController@index')->with([
            'flash_level' => 'success',
            'flash_message' => trans('admin.reset-success'),
        ]);
    }
}
