<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.skypack.dev/pin/@hotwired/turbo@v7.2.5-jwYMmpCb8mVWq1WRn6YH/mode=imports,min/optimized/@hotwired/turbo.js"></script>
    <script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';
    </script>
    <link rel="stylesheet" href="/style/style.css">
</head>
<body>
<header class="p-1 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between py-2">
            <a href="/" class="nav-link">Главная</a>
            <div class="text-end">
                <?php if (auth()->isAuthUser()): ?>
                    <div class="d-flex">
                        <a href="/home" type="button"
                           class="btn btn-sm btn-warning me-2"><?= auth()->user()['login'] ?></a>
                        <form action="/exit" method="POST">
                            <button type="submit" class="btn btn-sm btn-outline-light me-2">Выход</button>
                        </form>
                    </div>
                <?php else: ?>
                    <a href="/login" type="button" class="btn btn-sm btn-outline-light me-2">Вход</a>
                    <a href="/registration" type="button" class="btn btn-sm btn-warning">Регистрация</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <?= $mainContent ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>