<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page"  style="background-image: url('{{ asset('dist/img/back.jpg')}}');background-repeat: no-repeat;background-size: cover;background-position: center;">
<button class="btn btn-success m-b-10 m-l-5 float-left " style="margin-left: 20px" onclick="goBack()">

   رجوع
</button>
<div class="login-box">
    <p style="font-size: 30px; color: white ; text-align: center ;font-weight: 900">استبانات المتدربين كليه الاتصالات والالكترونيات بجده</p>
    <br>
    <!-- /.login-logo -->
    <div class="card">
        <div class="login-logo">
            <a href="">تسجيل دخول الطالب</a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <img alt="user-img" width="150px;" height="100px" src="{{URL::asset('dist/img/logo.webp')}}">

            </p>

            <form action="{{route('student_post_login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control" placeholder="الرقم التدريبي">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary  ">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
