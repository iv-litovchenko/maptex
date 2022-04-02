<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminPostStoreRequest;
use App\Http\Requests\AdminPostUpdateRequest;
use App\Models\Post;
use App\Utils\FrontendUility;

/**
 * Контроллер - управление постами
 *
 * GET|HEAD     |admin/post                 |admin.post.index
 * GET|HEAD     |admin/post/{post}          |admin.post.show
 * GET|HEAD     |admin/post/create          |admin.post.create
 * POST         |admin/post                 |admin.post.store
 * GET|HEAD     |admin/post/{post}/edit     |admin.post.edit
 * PUT|PATCH    |admin/post/{post}          |admin.post.update
 * DELETE       |admin/post/{post}          |admin.post.destroy
 * GET          |admin/post/{post}/delete   |admin.post.delete
 *
 */
class PostController extends BaseController
{
    /**
     * Список постов
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Создать новый пост (форма)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $postsTreeArray = FrontendUility::buildTreeArray();
        $defaultParentId = request()->input('default_parent_id');
        return view('admin.post.create', compact(
            'postsTreeArray',
            'defaultParentId'
        ));
    }

    /**
     * Создать новый пост (процесс)
     *
     * @param \App\Http\Requests\AdminPostStoreRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function store(AdminPostStoreRequest $request, Post $post)
    {
        $post->name = $request->input('name');
        $post->parent_id = $request->input('parent_id');
        if ($post->save()) {
            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно создан');

            // Создать и к просмотру
            if ($request->input('redirect') == 'show') {
                return redirect()->route('site.post', $post->id);
            }

            return redirect()->route('admin.post.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка создания поста');
        return redirect()->route('admin.post.create')->withInput();
    }

    /**
     * Редактировать пост (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $images = Storage::disk('public')->allFiles('site/post/' . $post->id);
        $postsTreeArray = FrontendUility::buildTreeArray();
        return view('admin.post.edit', compact(
            'post',
            'images',
            'postsTreeArray'
        ));
    }

    /**
     * Обновить пост (процесс)
     *
     * @param \App\Http\Requests\AdminPostUpdateRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function update(AdminPostUpdateRequest $request, Post $post)
    {
        $post->name = $request->input('name');
        $post->parent_id = $request->input('parent_id');
        $post->description = $request->input('description');
        $post->branch_stop_flag = intval($request->input('branch_stop_flag'));
        $post->sorting = intval($request->input('sorting'));

        // Логотип: загрузка (отсоединение) 1 файла
        // Зарисовка: загрузка (отсоединение) 1 файла
        // Изображения: загрузка нескольких картинок (в базу не пишем)
        $post->logo_image = $this->serviceFilePublic->attachOrDetach(false, 'logo_image', 'site/post/logo',
            $post->logo_image);

        $post->figma_image = $this->serviceFilePublic->attachOrDetach(false, 'figma_image', 'site/post/figma',
            $post->figma_image);

        $this->serviceFilePublic->attachOrDetach(true, 'images', 'site/post/' . $post->id);

        if ($post->save()) {
            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно обновлен');

            // Сохранение и к просмотру
            if ($request->input('redirect') == 'show') {
                return redirect()->route('site.post', $post->id);
            }

            return redirect()->route('admin.post.edit', $post->id);
        }

        $request->session()->flash('flash_messages_error', 'Ошибка обновления поста [' . $post->id . ']');
        return redirect()->route('admin.post.edit', $post->id)->withInput();
    }

    /**
     * Удалить пост (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function delete(Post $post)
    {
        return view('admin.post.delete', compact('post'));
    }

    /**
     * Удалить пост (процесс)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Post $post)
    {
        if ($post->delete()) {

            // Чистим диск (логотип)
            $path = 'site/post/logo/' . $post->logo_image;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Чистим диск (изображения)
            $path = 'site/post/' . $post->id;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->deleteDirectory($path);
            }

            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно удален');
            return redirect()->route('admin.post.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка удаления поста [' . $post->id . ']');
        return redirect()->route('admin.post.index');
    }
}
