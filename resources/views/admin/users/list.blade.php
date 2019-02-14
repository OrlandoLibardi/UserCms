<div class="col-md-7">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Usuários Cadastrados</h5>
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
                                <td>Nome</td>
                                <td>Email</td>
                                <td>Nível</td>
                                <td>Editar</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key=>$user)
                            <tr>
                                <td> <input type="checkbox" name="exclude" value="{{ $user->id }}"> </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <span class="badge badge-info badge-lg">{{ $v }}</span>
                                    @endforeach
                                    @endif
                                </td>
                                <td class="text-center"><a href="{{ route('users.edit', ['id' => $user->id])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>



            </div>
        </div>
    </div>
</div>
