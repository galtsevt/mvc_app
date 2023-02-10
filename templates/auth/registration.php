<div class="m-auto" style="width: 300px;">
    <?php if($error = session()->getFlash('error')): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>
<div class="card shadow border-0">
    <div class="card-header bg-dark text-light">
        <div class="d-flex justify-content-between">
            <div class="my-auto">Регистрация</div>
            <a class="btn btn-sm btn-light" href="/"><i class="bi bi-house-door-fill"></i></a>
        </div>
    </div>
    <div class="card-body">
        <form action="/registration" method="POST">
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
                <label for="" class="form-label">ФИО:</label>
                <input type="text" name="full_name" class="form-control" value="">
                <?php if(session()->hasError('full_name')): ?>
                    <div class="text-danger">
                        <?= session()->getError('full_name') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3 fw-bold">
                <label for="" class="form-label">E-Mail:</label>
                <input type="email" name="email" class="form-control" value="">
                <?php if(session()->hasError('email')): ?>
                    <div class="text-danger">
                        <?= session()->getError('email') ?>
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
            <div class="mb-3 fw-bold">
                <label for="" class="form-label">Повторите пароль:</label>
                <input type="password" name="confirm_password" class="form-control" value="">
                <?php if(session()->hasError('confirm_password')): ?>
                    <div class="text-danger">
                        <?= session()->getError('confirm_password') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-1">
                <button class="btn btn-dark" type="submit">Регистрация</button>
            </div>
        </form>
    </div>
</div>
</div>