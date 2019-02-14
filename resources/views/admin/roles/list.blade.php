<div class="col-md-7">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Grupos Cadastradas</h5>
                <div class="ibox-tools">
																				
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
																					<table class="table table-bordered" id="results">
																						<thead>
																								<tr>
																											<td width="10"><input type="checkbox" name="excludeAll"></td>
																											<th width="100">Nome</th>
																											<th>Permissões</th>
																											<th width="50">Editar</th>
																								</tr>
																						</thead>
																						<tbody>
																							@foreach( $roles as $role)
																							
																							 	<tr>
																											<td><input type="checkbox" name="exclude" value="{{ $role->id }}"> </td>
																											<td>{{ $role->name }}</td>
																											<td>
																													@foreach($permission_list[$role->id] as $pl )
																													<span class="badge badge-info badge-lg">
																															{{ $pl->name }}
																													</span>
																													@endforeach
																											</td>
																											<td class="text-center"><a href="{{ route('roles.edit', ['id' => $role->id])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a></td>																											
																									</tr>
																								@endforeach
																						</tbody>
																					</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
