<!doctype html>
<html lang="en">
    <head>
        <title>JY Store Portal - <?= $this->fetch('title') ?></title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?= $this->request->getAttribute('csrfToken') ?>">

        <!-- CSS libraries -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/daisyui@5" type="text/css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>

    <body class="min-h-screen bg-base-300">
        <div class="drawer lg:drawer-open">
            <input type="checkbox" id="drawer" class="drawer-toggle">

            <div class="drawer-content">
                <!-- top menu -->
                <div class="navbar bg-neutral text-neutral-content w-full">
                    <div class="flex-1">
                        <label for="drawer" class="btn btn-square btn-ghost draw-button lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4"><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path><path d="M9 4v16"></path><path d="M14 10l2 2l-2 2"></path></svg>
                        </label>

                        <span class="font-bold align-middle lg:px-3">JY Store Portal</span>
                    </div>
                        
                    <div class="flex-none">
                        <ul class="menu menu-horizontal px-1">
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'logout']) ?>" id="logout">Logout</a>
                            </li>
                        </ul>
                    </div>

                    <form id="form-logout" action="<?= $this->Url->build(['_name' => 'logout']) ?>" method="POST">
                    </form>
                </div>

                <!-- main -->
                <div class="p-5">
                    <?= $this->fetch('main') ?>
                </div>
            </div>

            <div class="drawer-side">
                <label for="drawer" class="drawer-overlay" aria-label="close sidebar"></label>

                <!-- side menu -->
                <ul class="menu bg-white min-h-full w-60 pt-10 px-4">
                    <li class="<?php if (stripos($this->request->getParam('_matchedRoute'), 'dashboard') !== false): ?> menu-active <?php endif; ?>">
                        <a href="<?= $this->Url->build(['_name' => 'dashboard']) ?>" class="py-3">
                            <i class="fas fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>

                    <li class="<?php if (stripos($this->request->getParam('_matchedRoute'), 'users') !== false): ?> menu-active <?php endif; ?>"">
                        <a href="<?= $this->Url->build(['_name' => 'users.index']) ?>" class="py-3">
                            <i class="fas fa-fw fa-users"></i> Users
                        </a>
                    </li>

                    <li class="<?php if (stripos($this->request->getParam('_matchedRoute'), 'products') !== false): ?> menu-active <?php endif; ?>">
                        <a href="<?= $this->Url->build(['_name' => 'products.index']) ?>" class="py-3">
                            <i class="fas fa-fw fa-boxes"></i> Products
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- JS libraries -->
        <script src="//cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="//code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- custom JS-->
        <script src="<?= $this->Url->script('base.js'); ?>"></script>
        <script>
            $('#logout').click(function(e)
            {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    text: 'Proceed to logout?'
                })
                .then(function(result)
                {   
                    if (result.isConfirmed)
                    {
                        $('#form-logout').submit();
                    }
                });
            });

            $('#form-logout').submit(function(e)
            {
                e.preventDefault();

                const form = $(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json'
                })
                .done(function(res)
                {
                    if (res.status == 'error')
                    {
                        Swal.fire({
                            icon: res.status,
                            text: res.message
                        });
                    }
                        
                    else 
                    {
                        // backend handle the redirection upon page reload
                        window.location.reload();
                    }
                });
            });
        </script>
        <?= $this->fetch('js') ?>
    </body>
</html>
