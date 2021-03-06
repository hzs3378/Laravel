<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
use Mail;
use Validator;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [ 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
//        $users = User::all();
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {

        return view('users.create');

    }

    public function show(User $user,Request $request)
    {

        var_dump($user->name);
//        try {
//            $this->authorize ('update', $user);
//            return view ('users.show', compact ('user'));
//        } catch (\Exception $e) {
//            session()->flash('danger','对不起,您无权访问该页面');
//            return redirect()->route('users.show', [Auth::user()]);
//        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_num|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

//        发送激活邮件至用户邮箱
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');

//        注册并自动登录
//        Auth::login($user);
//        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
//        return redirect()->route('users.show', [$user]);
    }

//    邮件内容
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'aufree@yousails.com';
        $name = 'Aufree';
        $to = $user->email;
        $subject = "感谢注册 Exp 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

//    激活邮箱方法
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，账户激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
//        $this->authorize('update', $user);
//        return view('users.edit', compact('user'));


        try {
            $this->authorize ('update', $user);
            return view ('users.edit', compact ('user'));
        } catch (\Exception $e) {
            session()->flash('danger','对不起,您无权访问该页面');
            return redirect()->route('users.edit', [Auth::user()]);
        }
    }

    public function update(User $user,Request $request)
    {

        $input = $request->all();
        $valid = [
            'name' => 'required|min:2|max:255',
        ];
        $messa = [
            'name.required' => '姓名不能为空啊',
        ];

        $validator = Validator::make($input, $valid, $messa);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'message' => 'There are incorect values in the form!',
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        $ds = $user->find(1);
        echo json_encode($ds);
    }

    public function updatea(User $user,Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
//            'password' => 'required|min:1|max:20|confirmed'
            'password' => 'nullable|min:1|max:20|confirmed'
        ]);

        //表示一个必须填写密码修改，另一个可以忽略密码进行更新

//        $user->update([
//            'name' => $request->name,
//            'password' => bcrypt($request->password),
//        ]);
        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success','个人信息修改成功');
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }


}
