<?php
namespace App\Http\Controllers\Admin;
use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/18
 * Time: 21:43
 */
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $teacher = DB::table('teacher')->where('username', $request['admin_user'])->first();
        if (empty($teacher)) return response()->json(['dec' => $this->admin_login_err]);
        if ($teacher->password != $request['admin_password']) return response()->json(['dec' => $this->admin_login_err]);
        return response()->json(['dec' => $this->admin_success, 'data' => $teacher]);
    }
}