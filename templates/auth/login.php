<div class="m-auto" style="width: 300px;">
    <?php if($error = session()->getFlash('error')): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif; ?>
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-light">
            <div class="d-flex justify-content-between">
                <div class="my-auto">Авторизация</div>
                <a class="btn btn-sm btn-light" href="/"><i class="bi bi-house-door-fill"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="/login" method="POST">
                <div class="mb-3 fw-bold">
                    <label for="" class="form-label">Логин:</label>
                    <input type="text" name="login" class="form-control" value="">
                    <?php if(session()->hasError('login')): ?>
                        <div class="text-danger">
                            <?= session()->getError('login') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3 fw-bold">
                    <label for="" class="form-label">Пароль:</label>
                    <input type="password" name="password" class="form-control" value="">
                    <?php if(session()->hasError('password')): ?>
                        <div class="text-danger">
                            <?= session()->getError('password') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-1">
                    <button class="btn btn-dark" type="submit">Вход</button>
                </div>
            </form>
        </div>
    </div>
</div>
