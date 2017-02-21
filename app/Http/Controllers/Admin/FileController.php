<?php
/**
 * Created by PhpStorm.
 * User: ihere
 * Date: 2017/2/19
 * Time: 10:12
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    //课件列表
    public function file_list(Request $request)
    {
        if (empty($request['current']) || empty($request['pagesize'])) return response()->json(['dec' => $this->admin_client_err]);
        $current = $request['current'];
        $pagesize = $request['pagesize'];
        $files = DB::table('file')->leftJoin('object', 'file.object_id', '=', 'object.object_id')
            ->select('file_id', 'object_name', 'file_name', 'file_type')
            ->orderBy('file_id', 'desc')
            ->skip(($current - 1) * $pagesize)
            ->take($pagesize)
            ->get();
        $total = DB::table('file')->count();
        return response()->json(['dec' => $this->admin_success, 'data' => $files, 'total' => $total]);
    }

    //删除课件
    public function file_delete(Request $request)
    {
        if (empty($request['o_id'])) return response()->json(['dec' => $this->admin_client_err]);
        $file = DB::table('file')->where('file_id', $request['o_id'])
            ->first();
        if (empty($file)) return response()->json(['dec' => $this->admin_client_err]);
        if (is_file($file->path)) {
            unlink($file->path);
        }
        DB::table('file')->where('file_id', $request['o_id'])
            ->delete();
        return response()->json(['dec' => $this->admin_success]);
    }

    //新增课件
    public function file_add(Request $request)
    {
        if (empty($request['file_name']) || !$request->hasFile('file') || !is_numeric($request['object'])) return response()->json(['dec' => $this->admin_client_err]);
        $file = $request->file('file');
        $clientName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $doc = 'doc,docx,dot,dotx,docm,dotm';
        $ppt = 'ppt,pptx,pps,ppsx,pptm,ppsm';
        if ($extension == 'mp4') {
            $file_type = 0;
        } elseif ($extension == 'pdf') {
            $file_type = 1;
        } elseif (strpos($doc, $extension) !== false) {
            $file_type = 2;
        } elseif (strpos($ppt, $extension) !== false) {
            $file_type = 3;
        } else {
            return response()->json(['dec' => $this->admin_data_err]);
        }
        $savePath = config('C.file_save_path');
        $saveName = md5(uniqid('', true) . $clientName) . "." . $extension;
        $file->move($savePath, $saveName);
        $path = $savePath . '/' . $saveName;
        DB::table('file')->insert(['file_name' => $request['file_name'], 'path' => $path, 'file_type' => $file_type, 'object_id' => $request['object'], 'create_at' => time()]);

        return response()->json(['dec' => $this->admin_success]);
    }
}