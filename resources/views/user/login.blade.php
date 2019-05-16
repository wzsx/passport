<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form class="form-signin" action="/userinfo" method="post">
    {{csrf_field()}}
    <h2 class="form-signin-heading">请登录</h2>
    {{--<input type="hidden" value="{{$redirect}}" name="redirect">--}}
    <label for="inputName">账号</label>
    <input type="name" name="u" >
    <br>
    <label for="inputPassword" >密码</label>
    <input type="password" name="p" >
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
</form>

</body>
</html>