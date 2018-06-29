@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>更新个人资料</h5>
            </div>
            <button class="btn btn-primary" onclick="ajaxup1()">测试</button>
            <div class="panel-body">

                @include('shared._errors')

                <div class="gravatar_edit">
                    <a href="http://gravatar.com/emails" target="_blank">
                        <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
                    </a>
                </div>

                {{--<form method="POST" id="ajaxup" action="{{ route('users.update', $user->id )}}" onsubmit="return ajaxup()">--}}
{{--                    {{ method_field('PATCH') }}--}}
                    {{--{{ csrf_field() }}--}}

                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" id="adwd" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="ajaxup()">更新</button>
                {{--</form>--}}
            </div>
        </div>
    </div>
    <script>
        // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        function ajaxup()
        {
            var c_token = $('meta[name="_token"]').attr('content');
            var adwd    = $('#adwd').val();
            // console.log($adwd);  route('')
            $.ajax({
                type: 'POST',
                {{--url: '{{ url('/users/1') }}',--}}
                url: '{{ route('users.update', [1]) }}',
                data: { name : adwd,'_method':'PATCH'},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': c_token
                },
                success: function(data){
                    console.log(data);
                },
                error: function(xhr, type){
                    console.log(xhr);
                }
            });
        }

        function ajaxup1()
        {
            $.ajax({
                type: 'GET',
                // url: '/about',
{{--                url: '{{ url("/about") }}',--}}
                url: '{{ route('about') }}',
//                 data: { name : '1'},
                dataType: 'json',
                // headers: {
                //     'X-CSRF-TOKEN': c_token
                // },
                success: function(data){
                    console.log(data);
                },
                error: function(xhr, type){
                    // console.log(xhr);
                    console.log(type);
                }
            });
        }
    </script>
@stop