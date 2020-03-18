<div class="card shadow">
	<div class="card-header">
		<div class="row">
			<div class="col-12"><H4 class="text-center">Настройки пользователя</H4></div>
		</div>
	</div>
	<div class="card-body">
		<div class="container">
			<form action="/settings/save" method="get">
				<div class="form-group">
					<div class="row" >
						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<label for="login" class="col-form-label"><b>Логин</b></label>
                                    <input id="login" type="text" name="login" readonly class="form-control" style="width: 100%" value="<?= $_SESSION['account']['email'];?>">
								</div>
								<div class="col-6">
                                    <label for="password" class="col-form-label"><b>Пароль</b></label>
                                    <input id="password" type="text" name="password" class="form-control" value=" ">
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="form-group">
                    <div class="row" >
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <label for="f_name" class="col-form-label"><b>Имя</b></label>
                                    <input id="f_name" type="text" name="f_name"  class="form-control" value="<?= $_SESSION['account']['f_name'];?>">
                                </div>
                                <div class="col-4">
                                    <label for="l_name" class="col-form-label"><b>Фамилия</b></label>
                                    <input id="l_name" type="text" name="l_name" class="form-control" value="<?= $_SESSION['account']['l_name'];?>">
                                </div>
                                <div class="col-4">
                                    <label for="m_name" class="col-form-label"><b>Отчество</b></label>
                                    <input id="m_name" type="text" name="m_name" class="form-control" value="<?= $_SESSION['account']['m_name'];?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


				<div class="form-group">
					<button type="submit" class="btn btn-success">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

