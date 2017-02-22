<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/19
 * Time: 12:53
 */

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        //读取配置文件
        $data = config('C');
        if (empty($request['current'])) {
            $request['current'] = 1;
        }
        $current = $request['current'];
        $pagesize = 6;
        //课件
        $file = DB::table('file')->leftJoin('object', 'object.object_id', '=', 'file.object_id')
        ->select('file_name', 'file_type', 'path', 'object_name', 'create_at')
        ->whereIn('file_type', [0,1])
        ->orderBy('file_id', 'desc')
        ->skip(($current - 1) * $pagesize)
        ->take($pagesize)
        ->get();
        $count = DB::table('file')
            ->select('file_name')
            ->count();
        $data['file_list'] = $file;
        //留言
        $messages = DB::table('message')->leftJoin('students', 'students.student_id', '=', 'message.user_id')
            ->select('content', 'name', 'create_at', 'avatar')
            ->orderBy('message_id', 'desc')
            ->limit(12)
            ->get();
        if (!empty($messages)) {
            foreach ($messages as $message) {
                if (empty($message->name)) {
                    $message->name = '匿名用户';
                }
            }
        }
        $data['messages'] = $messages;
        //学科
        $objects = DB::table('object')->orderBy('object_id', 'asc')
            ->get();
        if (!empty($objects)) {
            foreach ($objects as $object) {
                $num = DB::table('file')->where(['object_id'=>$object->object_id])
                    ->whereIn('file_type', [2,3])
                    ->count();
                $object->num = $num;
            }
        }
        $data['objects'] = $objects;
        $data['current'] = $current;
        $data['file_count'] = $count;
        $data['file_total_page'] = ceil($count/$pagesize);
        $data['page_url'] = '';
        //检查登录状态
        session_set_cookie_params(3600*24*7);
        session_start();
        if (!empty($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        }
        return view('blog', $data);
    }
}