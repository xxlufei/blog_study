<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/19
 * Time: 21:29
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function messages(Request $request)
    {
        //读取配置文件
        $data = config('C');
        if (empty($request['current']) ){
            $request['current'] = 1;
        }
        $current = $request['current'];
        $pagesize = 10;
        $messages = DB::table('message')->leftJoin('students', 'students.student_id', '=', 'message.user_id')
            ->select('message_id', 'content', 'name', 'create_at', 'avatar')
            ->orderBy('message_id', 'desc')
            ->skip(($current - 1) * $pagesize)
            ->take($pagesize)
            ->get();
        if (!empty($messages)) {
            foreach ($messages as $message) {
                if (empty($message->name)) {
                    $message->name = '匿名用户';
                }
            }
        }
        $total = ceil(DB::table('message')->count()/$pagesize);
        $data['messages'] = $messages;
        $data['current'] = $current;
        $data['file_total_page'] = $total;
        session_set_cookie_params(3600*24*7);
        session_start();
        if (!empty($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        }
        return view('message', $data);
    }

    public function message_add(Request $request)
    {
        if (empty($request['content'])) return response()->json(['dec' => $this->admin_client_err]);
        if (!empty($request['user_id'])) {
            $data['user_id'] = $request['user_id'];
        }
        $data['content'] = $request['content'];
        $data['create_at'] = time();
        DB::table('message')->insert($data);
        return response()->json(['dec' => $this->admin_success]);
    }
}