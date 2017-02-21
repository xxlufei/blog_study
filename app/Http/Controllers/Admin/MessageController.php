<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/19
 * Time: 9:11
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MessageController extends Controller
{
    //留言列表
    public function message_list(Request $request)
    {
        if (empty($request['current']) || empty($request['pagesize'])) return response()->json(['dec' => $this->admin_client_err]);
        $current = $request['current'];
        $pagesize = $request['pagesize'];
        $messages = DB::table('message')->leftJoin('students', 'students.student_id', '=', 'message.user_id')
            ->select('message_id', 'content', 'name')
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
        $total = DB::table('message')->count();
        return response()->json(['dec' => $this->admin_success, 'data' => $messages, 'total' => $total]);
    }

    //删除留言
    public function message_delete(Request $request)
    {
        if (empty($request['o_id'])) return response()->json(['dec' => $this->admin_client_err]);
        DB::table('message')->where('message_id', $request['o_id'])
            ->delete();
        return response()->json(['dec' => $this->admin_success]);
    }

    //新增留言
    public function message_add(Request $request)
    {
        if (empty($request['content'])) return response()->json(['dec' => $this->admin_client_err]);
        DB::table('message')->insert(['content' => $request['content'], 'create_at' => time()]);
        return response()->json(['dec' => $this->admin_success]);
    }

    //修改留言
    public function message_update(Request $request)
    {
        if (empty($request['o_id']) && empty($request['content'])) return response()->json(['dec' => $this->admin_client_err]);
        DB::table('message')->where('message_id', $request['o_id'])
            ->update(['content'=>$request['content']]);
        return response()->json(['dec' => $this->admin_success]);
    }
}