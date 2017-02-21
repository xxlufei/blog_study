<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $admin_success            = array('code' => '200000', 'msg' => '操作成功');
    protected $admin_login_err          = array('code' => '260001', 'msg' => '用户或密码不正确，请重新输入');
    protected $admin_error              = array('code' => '260002', 'msg' => '操作失败');
    protected $admin_data_err           = array('code' => '260003', 'msg' => '请上传视频或PDF文件');
    protected $admin_regist_err         = array('code' => '260004', 'msg' => '已存在相同的用户名');
    protected $admin_client_err         = array('code' => '260005', 'msg' => '客户端参数错误');
    protected $admin_add_err            = array('code' => '260006', 'msg' => '已存在,请勿重复添加');
    protected $admin_u_p_err            = array('code' => '260007', 'msg' => '用户名或密码错误');
    protected $admin_old_pass_err       = array('code' => '260008', 'msg' => '原始密码错误');
    protected $admin_old_no_err         = array('code' => '260009', 'msg' => '与原始密码一致，无需修改');
    protected $admin_user_err      = array('code' => '260010', 'msg' => '用户名');
}
