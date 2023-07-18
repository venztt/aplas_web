<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: flex-start;
            display: flex;
            justify-content: left;
            margin-left: 5%;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .video {
            margin-top: 12%;
            margin-left: 12%;
        }

        .contact {
            margin-top: 20%;
            font-size: 13px;
            text-align: center;
            color: #636b6f;
            letter-spacing: .07rem;
            margin-bottom: 2px;
        }

        .info {
            margin-top: 2px;
            color: #636b6f;
            font-size: 13px;
            text-align: center;
            color: #636b6f;
            letter-spacing: .07rem;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
<div class="flex-center position-ref full-height">
    <?php if(Route::has('login')): ?>
        <div class="top-right links">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/home')); ?>">Home</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>">Login</a>

                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>


    <div class="content">
        <div class="title m-b-md">
            <p>Welcome to</p>
            <img src="<?php echo e(asset('lte/dist/img/logo-aplas.png')); ?>" alt="APLAS logo" class="brand-image elevation-3"
                 style="opacity: .8">
        </div>

        <div class="links">
            <p>A self learning of Android applications programming with automatic checking feature</p>
        </div>
        <div>
            <p class="contact">Email: <span
                    style="font-weight: bold; font-size:13px;color:#636b6f">qulis＠polinema.ac.id</span></p>
            <p class="info">To prevent email spam, Please replace <span style="font-weight: bold;">＠</span> with the @
                mark.</p>
        </div>
    </div>

    <div class="video">
        <iframe width="460" height="325" src="//www.youtube.com/embed/Fxb83_UFI0M" frameborder="0"
                allowfullscreen></iframe>
    </div>

</div>

</body>

</html>
<?php /**PATH D:\Kuliah\Skripsi\code\resources\views/welcome.blade.php ENDPATH**/ ?>