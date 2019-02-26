<div class="col-md-5">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Editar um usuário</h5>
					<div class="ibox-tools">
						<a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
								{!! Form::open(['route' => ['users.update', $user->id], 'method'=>'PUT', 'id'=>'form', 'name' => 'form-user']) !!}	
								{!! Form::hidden("id", $user->id) !!}
									<div class="col-sm-6">
										<div class="form-group">
											<label><span class="text-red">*</span> Nome</label>
											{!! Form::text('name', $user->name, ['placeholder' => 'Nome...','class' => 'form-control']) !!}
										</div>
										<div class="form-group">
											<label><span class="text-red">*</span> E-mail</label>
											{!! Form::text('email', $user->email, ['placeholder' => 'Email...','class' => 'form-control']) !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label> <span class="text-red">*</span> Senha</label>
											{!! Form::password('password', ['placeholder' => 'Senha...','class' => 'form-control']) !!}
										</div>
										<div class="form-group">
											<label> <span class="text-red">*</span> Nível</label>
											{!! Form::select('role', $roles, $userRole, ['class' => 'form-control', 'placeholder' => '--Selecione--']) !!}
										</div>
									</div>
							{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>