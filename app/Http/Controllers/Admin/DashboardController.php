<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\AdminPostStoreRequest;
use App\Models\Post;

/**
 * Контроллер - главная страница административного раздела
 */
class DashboardController extends BaseController
{
    /**
     * Вывод списка модулей (одноименный контроллер)
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('admin.dashboard');
    }
}
