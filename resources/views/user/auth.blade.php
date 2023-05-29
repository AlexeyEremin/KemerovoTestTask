<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Авторизация в системе</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="inputLogin" class="form-label">Логин</label>
                        <input type="text" name="login" class="form-control" id="inputLogin">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                    <button type="submit" class="btn btn-success">Авторизоваться</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>