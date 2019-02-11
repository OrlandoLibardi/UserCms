<div class="col-md-5">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Editar um grupo com permissão</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
																	<form id="form" action="{{ route('roles.update', ['id' => $role->id]) }}" method="PUT">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                <span class="text-red">*</span> Nome</label>
                            <input type="text" name="nome" placeholder="Nome..." class="form-control" value="{{ $role->name }}">
                        </div>
                    </div>
                    <div class="col-md-12">
																					   <div class="form-group">
                            <label style="display:block; margin-bottom:10px;">
                                <span class="text-red">*</span> Permissões</label>
                            @foreach($permission as $value)
																												@php $check = in_array($value->id, $rolePermissions) ? "checked" : false; @endphp
                            <label style="width:150px; font-weight:100;">
                                <input type="checkbox" name="permissao[]" {{$check}} value="{{ $value->id }}"> {{ $value->name }} </label>
                            @endforeach
                        </div>
                    </div>
																			
																		</form>
                </div>
            </div>
        </div>
    </div>