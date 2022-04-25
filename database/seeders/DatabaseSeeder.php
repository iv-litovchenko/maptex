<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function app_path;
use function app_storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);*/

        \App\Models\User::factory(1)->create();
        \App\Models\Note::factory(100)->create();
        \App\Models\Post::factory(100)->create();

        // Создание дерева
        $rows = \App\Models\Post::where('id', '>', 7)->get();
        foreach ($rows as $row) {
            $model = \App\Models\Post::find($row->id);
            $nodeId = random_int(2, 10); // !!! Cannot move node into itself.
            if ($nodeId !== $row->id) {
                $model->parent_id = $nodeId;
            }
            $model->save();
        }

        // Копируем картинку (логотип для постов)
        if (!File::exists(app_path('storage/app/public/logo.png'))) {
            // File::copy(
            //     app_path('resources/assets/images/logo.png'),
            //     app_path('public/storage/logo.png')
            // );
        }

        // Наполнение таблицы сигналов
        DB::table('tv_signals')->insert([
            'strategy' => 'RTS'
        ]);
    }
}
