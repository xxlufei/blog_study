<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/18
 * Time: 22:07
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        //读取配置文件
        $data = config('C');
        return view('login', $data);
    }

    public function login1(Request $request)
    {
        if (empty($request['username']) || empty($request['password'])) return response()->json(['dec' => $this->admin_client_err]);
        $user = DB::table('students')->where('username', $request['username'])->first();
        if (empty($user)) return response()->json(['dec' => $this->admin_u_p_err]);
        if ($user->password != md5($request['password'])) return response()->json(['dec' => $this->admin_u_p_err]);
        //登录成功
        if (!empty($request['remember'])) {
            session_set_cookie_params(3600 * 24 * 7);
        }
        session_start();
        $_SESSION['user'] = $user;
        return response()->json(['dec' => $this->admin_success]);
    }

    public function logout()
    {
        session_start();
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setCookie(session_name(), '', time() - 3600, '/');
        }
        session_destroy();
        return Redirect::to("/");
        return response()->json(['dec' => $this->admin_success]);
    }

    //注册
    public function register(Request $request)
    {
        //读取配置文件
        $data = config('C');
        return view('register', $data);
    }

    //注册
    public function register1(Request $request)
    {
        if (empty($request['email']) || empty($request['nickname'])) return response()->json(['dec' => $this->admin_client_err]);
        if (empty($request['pwd']) || $request['pwd'] != $request['repwd']) return response()->json(['dec' => $this->admin_client_err]);
        $email = DB::table('students')->where('username', $request['email'])->first();
        if (!empty($email)) return response()->json(['dec' => $this->admin_regist_err]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $clientName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $img = '.jpg.png.gif.jpeg';
            if (strpos($img, $extension) === false) {

                return response()->json(['dec' => $this->admin_client_err]);
            }
            $savePath = 'uploads/avatar';
            $saveName = md5(uniqid('', true) . $clientName) . "." . $extension;
            $file->move($savePath, $saveName);
            $path = $savePath . '/' . $saveName;
            $data['avatar'] = $path;
        }
        $data['name'] = $request['nickname'];
        $data['username'] = $request['email'];
        $data['password'] = md5($request['pwd']);
        $id = DB::table('students')->insertGetId($data);
        $user = DB::table('students')->where('student_id', $id)->first();
        //session_set_cookie_params(3600*24*7);
        session_start();
        $_SESSION['user'] = $user;
        return response()->json(['dec' => $this->admin_success]);
    }
}