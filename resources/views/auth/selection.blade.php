<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>الاستبيانات</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- css -->
    <link href="{{ URL::asset('dist/css/rtl.css') }}" rel="stylesheet">




</head>
<style>
    footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
    }
    footer a {
        color: #333;
        margin: 0 10px;
    }
</style>
<body>



    <div class="wrapper">

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
                 style="background-image: url('{{ asset('dist/img/back.jpg')}}');background-repeat: no-repeat;background-size: cover;background-position: center;">




            <div class="container">

                <p style="font-size: 30px; color: white ; text-align: center ;font-weight: 900">استبانات المتدربين كليه الاتصالات والالكترونيات بجده</p>
                <br>
                <div class="row justify-content-center no-gutters vertical-align">

                    <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">حدد طريقة الدخول</h3>
                            <div style="text-align: center">
                                <img alt="user-img" width="150px;" height="100px" src="{{URL::asset('dist/img/rtx.png')}}">

                            </div>

                            <div class="form-inline">
                                <a class="btn btn-default col-lg-3" title="طالب" href="{{route('student_login')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('dist/img/student.png')}}">
                                    <p>متدرب</p>
                                </a>
                                <a class="btn btn-default col-lg-3" title="زائر" href="{{route('visitor_index')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('dist/img/parent.png')}}">
                                    <p>زائر</p>
                                </a>
                                <a class="btn btn-default col-lg-3" title="معلم" href="{{route('teacher_login')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('dist/img/teacher.png')}}">
                                    <p>مدرب</p>
                                </a>
                                <a class="btn btn-default col-lg-3" title="ادمن" href="{{route('admin_login')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('dist/img/admin.png')}}">
                                    <p>مدير النظام</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
<br>

        </section>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col">

                        <a style="font-size: 25px" href="https://www.facebook.com/cte.edu.sa?mibextid=LQQJ4d" class="fa fa-facebook"></a>
                        <a style="font-size: 25px" href="https://twitter.com/CTE_EDU" class="fa fa-twitter"></a>

                        <a style="font-size: 25px" href="https://www.instagram.com/cte.edu.sa/" class="fa fa-instagram"></a>

                        <a style="font-size: 25px" href="https://t.snapchat.com/pXUuiolb" class="fa fa-snapchat-ghost"></a>

                        <a style="font-size: 25px" href="https://t.me/cte_edu_sa" class="fa fa-telegram"></a>

                    </div>
                </div>
            </div>
        </footer>

        <!--=================================
 login-->

    </div>
    <!-- jquery -->
    <script src="{{ URL::asset('dist/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('dist/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';

    </script>


    <!-- toastr -->
    @yield('js')
    <!-- custom -->
    <script src="{{ URL::asset('dist/js/custom.js') }}"></script>

</body>

</html>
