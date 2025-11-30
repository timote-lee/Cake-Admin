<!doctype html>
<html lang="en">
    <head>
        <title>Cake Portal - <?= $this->fetch('title') ?></title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?= $this->request->getAttribute('csrfToken') ?>">

        <!-- CSS -->
        <link rel="stylesheet" href="<?= $this->Url->css('auth.css'); ?>">
    </head>

    <body data-theme="light">
        <div class="main">
            <div class="body">
                <?= $this->fetch('main') ?>
            </div>
        </div>

        <!-- JS libraries -->
        <script src="//cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="//code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- JS -->
        <script src="<?= $this->Url->script('auth.js'); ?>"></script>

        <?= $this->fetch('js') ?>
    </body>
</html>
