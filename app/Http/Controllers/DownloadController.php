<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/21
 * Time: 12:35
 */

namespace App\Http\Controllers;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
{
    public function down_list(Request $request)
    {
        //读取配置文件
        $data = config('C');
        if (empty($request['current'])) {
            $request['current'] = 1;
        }
        $current = $request['current'];
        $pagesize = 10;
        $files = DB::table('file')->leftJoin('object', 'file.object_id', '=', 'object.object_id')
            ->select('file_id', 'path', 'object_name', 'file_name', 'file_type')
            ->where(function ($query) use($request){
                if (!empty($request['object_id'])) {
                    $query->where(['file.object_id' => $request['object_id']]);
                }
            })
            ->whereIn('file_type', [2, 3])
            ->orderBy('file_id', 'desc')
            ->skip(($current - 1) * $pagesize)
            ->take($pagesize)
            ->get();
        $total = ceil(DB::table('file')
                ->where(function ($query) use($request){
                    if (!empty($request['object_id'])) {
                        $query->where(['file.object_id' => $request['object_id']]);
                    }
                })
                ->whereIn('file_type', [2, 3])
                ->count() / $pagesize);
        $data['files'] = $files;
        $data['current'] = $current;
        $data['file_total_page'] = $total;
        session_set_cookie_params(3600 * 24 * 7);
        session_start();
        if (!empty($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        }
        if (!empty($request['object_id'])) {
            $data['object_id'] = $request['object_id'];
        } else {
            $data['object_id'] = false;
        }
        $data['page_url'] = 'download';
        return view('download', $data);
    }
}