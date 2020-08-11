<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php if(trim($__env->yieldContent('template_title'))): ?><?php echo $__env->yieldContent('template_title'); ?>
        | <?php endif; ?> <?php echo e(config('app.name', Lang::get('titles.app'))); ?></title>
    <meta name="description" content="">
    <link rel="shortcut icon" href="/favicon.ico">


    <meta name="google-site-verification" content="2LHQ9FhmPNIiLZ_e2hjMDRVYwLhhqsdKReqr1dk-NcE" />

    
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    
    <?php echo $__env->yieldContent('template_linked_fonts'); ?>

    
    <link href="<?php echo e(mix('/css/app.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('template_linked_css'); ?>

    <style type="text/css">
        <?php echo $__env->yieldContent('template_fastload_css'); ?>

            <?php if(Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0)): ?>
                .user-avatar-nav {
            background: url(<?php echo e(Gravatar::get(Auth::user()->email)); ?>) 50% 50% no-repeat;
            background-size: auto 100%;
        }
        <?php endif; ?>

    </style>

    
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
    </script>

    <?php if(Auth::User() && (Auth::User()->profile) && $theme->link != null && $theme->link != 'null'): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e($theme->link); ?>">
    <?php endif; ?>

    <?php echo $__env->yieldContent('head'); ?>

</head>
<body>
<div id="app">

    <?php if(auth()->guard()->check()): ?>
        <?php echo $__env->make('partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(auth()->guard()->guest()): ?>
        <div class="row text-center">
            <div class="col-12 mt-4">
                <img src="<?php echo e(asset('images/atm.png')); ?>">
            </div>
        </div>
    <?php endif; ?>

    <main class="py-4">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>

        <footer class="page-footer font-small blue pt-4">
            <div class="container-fluid text-center text-md-left">
                <div class="footer-copyright text-center py-3">© 2019 Copyright:
                    <a href="https://www.atm.gob.ec/"> ATM</a>
                </div>
            </div>
        </footer>
    </main>
</div>


<script src="<?php echo e(mix('/js/app.js')); ?>"></script>
<?php if(true): ?>//config('settings.googleMapsAPIStatus')) '.config("settings.googleMapsAPIKey").'
    <?php echo HTML::script('//maps.googleapis.com/maps/api/js?key=AIzaSyDYpfb7OTFs4oHrrNgLPl9qefqOdjjzLxE&libraries=places&dummy=.js', array('type' => 'text/javascript')); ?>

    
<?php endif; ?>

<?php echo $__env->yieldContent('footer_scripts'); ?>

</body>
</html>
<?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/layouts/app.blade.php ENDPATH**/ ?>