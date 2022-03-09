<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use App\Models\TechnologyModel;
use App\Models\UserModel;

class FrontendController extends BaseController
{
//    use AuthorizesRequests;
//    use DispatchesJobs;
//    use ValidatesRequests;

    public function index(Request $request)
    {
        return view('frontend', [
            'pageTitle' => 'Главная',
            'pageHeader' => 'Roadmap backend',
            'row' => [
                'id' => 0,
                'parent_id' => 0,
                'sorting' => 0
            ]
        ]);
    }

    public function tech(int $id = 0)
    {
        $model = TechnologyModel::find($id);

        $files = [];
        $path = public_path('images/posts/' . $model->id);
        if (File::exists($path)) {
            $files = File::files($path);
        }

        return view('frontend', [
            'pageTitle' => $model->name,
            'pageHeader' => $model->name,
            'back_id' => $model->parent_id,
            'row' => $model,
            'files' => $files
        ]);
    }

    public function login(Request $request)
    {
        $postUserId = $request->input('user_id');
        $postUserEmail = $request->input('user_email');
        $postUserPassword = $request->input('user_password');
        if ($postUserId > 0) {
            $row = UserModel::find($postUserId);
            if ($row->user_email == $postUserEmail
                &&
                $row->user_password == md5($postUserPassword)
            ) {
                $cookie = Cookie::forever('BACKEND_OPEN', 'yes');
                return response()
                    ->view('frontend-login-successfully')
                    ->withCookie($cookie);
            }
        }
        return view('frontend-login');
    }

    public function pics()
    {
        $path = public_path('images/pics');
        $files = File::files($path);

        return view('frontend-pics', [
            'pageTitle' => 'Разные картинки',
            'files' => $files
        ]);
    }

    public function books()
    {
        $path = public_path('images/books');
        $files = File::files($path);

        return view('frontend-books', [
            'pageTitle' => 'Книги',
            'files' => $files
        ]);
    }

    public function search(Request $request)
    {
        $inputQuerySearch = $request->input('q');
        $queryLike = $inputQuerySearch;
        $queryLike = '%' . str_ireplace(' ', '_', $queryLike) . '%';

        $rows = [];
        if ($inputQuerySearch != '') {
            $rows = TechnologyModel::where('name', 'like', $queryLike)
                ->orWhere('description', 'like', $queryLike)
                ->get();
        }

        return view('frontend-search', [
            'pageTitle' => 'Поиск по сайту',
            'q' => $inputQuerySearch,
            'searchResult' => $rows
        ]);
    }
}