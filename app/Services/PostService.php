<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostService
{
    /**
     * @param $name
     * @param $parent_id
     * @param $branch_stop_flag
     * @return void
     */
    public function create(
        string $name,
        int $parent_id = 0,
        int $branch_stop_flag = 0,
    ) {
        try {
            DB::beginTransaction();
            $model = new Post;
            $model->parent_id = $parent_id > 0 ? $parent_id : null;
            $model->name = $name;
            $model->branch_stop_flag = $branch_stop_flag;
            $model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }
}
