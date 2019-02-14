		<div class="col-md-5">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Criar um novo usuário</h5>
					<div class="ibox-tools">
						<a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
								{!! Form::open(['route' => 'users.store', 'method'=>'POST', 'id'=>'form', 'name' => 'form-user']) !!}	
									<div class="col-sm-6">
										<div class="form-group">
											<label><span class="text-red">*</span> Nome</label>
											{!! Form::text('nome', null, ['placeholder' => 'Nome...','class' => 'form-control']) !!}
										</div>
										<div class="form-group">
											<label><span class="text-red">*</span> E-mail</label>
											{!! Form::text('email', null, ['placeholder' => 'Email...','class' => 'form-control']) !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label> <span class="text-red">*</span> Senha</label>
											{!! Form::password('senha', ['placeholder' => 'Senha...','class' => 'form-control']) !!}
										</div>
										<div class="form-group">
											<label> <span class="text-red">*</span> Nível</label>
											{!! Form::select('permissoes', $roles, null, ['class' => 'form-control', 'placeholder' => '--Selecione--']) !!}
										</div>
									</div>
							{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>