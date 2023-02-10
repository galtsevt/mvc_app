<div class="mt-3">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow mb-2">
                <div class="card-body">
                    <div class="m-2 d-flex justify-content-center">
                        <img src="/style/images/user.svg" width="150px">
                    </div>
                    <div class="m-2">
                        <span class="fw-bold">ФИО:</span> <?= auth()->user()['full_name'] ?>
                    </div>
                    <div class="m-2">
                        <span class="fw-bold">E-mail:</span> <?= auth()->user()['email'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow mb-2">
                <div class="card-body">
                    <form action="/password/change" method="POST">
                        <div class="mb-3 fw-bold">
                            <label for="" class="form-label">Текущий пароль:</label>
                            <input type="password" name="old_password" class="form-control" value="">
                            <?php if(session()->hasError('old_password')): ?>
                                <div class="text-danger">
                                    <?= session()->getError('old_password') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 fw-bold">
                            <label for="" class="form-label">Новый пароль:</label>
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
                            <button class="btn btn-dark" type="submit">Сменить пароль</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

