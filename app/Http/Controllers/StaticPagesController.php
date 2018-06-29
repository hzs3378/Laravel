<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\Ordershipped;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StaticPagesController extends Controller
{
    public function home()
    {
//        return "主页";
        return view('static_pages/home');

    }

    public function help(Request $request)
    {
//        return view('static_pages/help');
//        原始sql操作
//        查询（结果为数组）
//        $users = DB::select('select * from users where activated = ? and is_admin = ?', [1,0]);

//        插入
//        $inser = DB::insert('insert into users (id,name,email,password) values (?,?,?,?)',[57,'原生insert','hh@joycore.com','dwanasd']);

//        修改
//        $updat = DB::update('update users set name=? where id = ?', ['修改参数',6]);

//        删除
//        $delete = DB::delete('delete from users where id = ?', [57]);
//        if($delete){
//            echo 'yes';
//        }else{
//            echo 'no';
//        }

//        查询构造器（结果为object结构）
//        $users = DB::table('users')->get();
//        foreach ($users as $user) {
//            echo $user->name.'<br />';
//        }

//        批量插入数据
//        DB::table('users')->insert([
//            ['email' => 'taylor@example.com', 'votes' => 0],
//            ['email' => 'dayle@example.com', 'votes' => 0]
//        ]);

//        获取新插入数据ID
//        $id = DB::table('users')->insertGetId(
//            ['email' => 'john@example.com', 'votes' => 0]
//        );

//        针对性取字段值
//        $userone = DB::table('users')->where('name','阿萨德')->value('email');
//        单条行数据
//        $userone = DB::table('users')->where('name','阿萨德')->first();
//        单列字段
//        $userone = DB::table('users')->pluck('name');
//        var_dump($userone);

//        分块查询 结果以查询数量分割为数组
//        DB::table('users')->orderBy('id')->chunk(20, function($users){
//            var_dump($users);
//        });
//        聚合方法 count max min avg sum
//        $count = DB::table('users')->count();
//        echo "统计总量：".$count.'<br />';
//        $min   = DB::table('users')->min('id');
//        echo "ID最小值：".$min.'<br />';
//        $max   = DB::table('users')->max('id');
//        echo "ID最大值：".$max.'<br />';

//        取出需要字段
//        $users = DB::table('users')->select('name','id','email as emails')->limit(10)->get();
//        var_dump($users);

//        结果去重
//        DB::table('users')->distinct()->get();

//        or条件查询
//        $oror = DB::table('users')->where('is_admin',1)->orwhere('activated',1)->get();
//        var_dump($oror);

//        按照日期进行排序
//        $date = DB::table('users')->latest()->get();
//        $date = DB::table('users')->oldest()->get();
//        var_dump($date);

//        条件语句
        $cs = null;
//        $users = DB::table('users')->when($cs, function($query) use ($cs){
//            return $query->orderBy('id', 'desc');
//        }, function($query){
//            return $query->orderBy('created_at', 'desc');
//        })->limit(5)->get();
//        var_dump($users);

//        悲观锁
//            共享锁
//            DB::table('users')->where('id', '<', '20')->sharedLock()->get();
//            更新锁
//            DB::table('users')->where('id', '<', '20')->lockForUpdate()->get();

            $newmy = DB::connection('mysql_or');

            $order = $newmy->select('select * from aaa');

            var_dump($order);
    }

    public function about()
    {
        echo 1;
//        return "关于";
//        return view('static_pages/about');
//        $pathToFile = '../storage/logs/laravel.log';
//        return response()->file($pathToFile);

    }

    public function ord(User $user)
    {
//        var_dump($user);
//        $post = Auth::class;
        Event::fire(new Ordershipped($user));
        echo '应该成功吧';
    }
}
