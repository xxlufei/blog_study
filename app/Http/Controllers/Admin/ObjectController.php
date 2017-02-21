<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/18
 * Time: 23:24
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectController extends Controller
{
    //科目列表
    public function object_list(Request $request)
    {
        if (empty($request['current']) || empty($request['pagesize'])) return response()->json(['dec' => $this->admin_client_err]);
        $current = $request['current'];
        $pagesize = $request['pagesize'];
        $objects = DB::table('object')->orderBy('object_id', 'asc')
            ->skip(($current - 1) * $pagesize)
            ->take($pagesize)
            ->get();
        $total = DB::table('object')->count();
        return response()->json(['dec' => $this->admin_success, 'data' => $objects, 'total' => $total]);
    }

    //科目列表_all
    public function object_list_all(Request $request)
    {
        $objects = DB::table('object')->orderBy('object_id', 'asc')
            ->get();
        return response()->json(['dec' => $this->admin_success, 'data' => $objects]);
    }

    //删除科目
    public function object_delete(Request $request)
    {
        if (empty($request['o_id'])) return response()->json(['dec' => $this->admin_client_err]);
        DB::table('object')->where('object_id', $request['o_id'])
            ->delete();
        return response()->json(['dec' => $this->admin_success]);
    }

    //新增学科
    public function object_add(Request $request)
    {
        if (empty($request['object_name'])) return response()->json(['dec' => $this->admin_client_err]);
        DB::table('object')->insert(['object_name' => $request['object_name']]);
        return response()->json(['dec' => $this->admin_success]);
    }

    //修改学科
    public function object_update(Request $request)
    {
        if (empty($request['o_id']) && empty($request['object_name'])) return response()->json(['dec' => $this->admin_client_err]);
        DB::table('object')->where('object_id', $request['o_id'])
            ->update(['object_name'=>$request['object_name']]);
        return response()->json(['dec' => $this->admin_success]);
    }
}