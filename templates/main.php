<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница</title>
    <?= vite('assets/js/app.js') ?>
</head>
<body class="h-100">
<div class="h-100 d-flex flex-column">
    <header class="p-1 text-bg-dark shadow-sm">
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
    <footer class="mt-auto">
        <div class="container">
            <div class="text-muted"><?= round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 4) ?> ms</div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>