<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<header class="p-1 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
            </ul>

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