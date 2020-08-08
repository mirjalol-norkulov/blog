@extends('dashboard.layouts.base')

@section('title')
    Foydalanuvchilar
@endsection

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="mr-2">Foydalanuvchilar</span>
                            <form action="{{ route('dashboard.users.index') }}" method="get">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="q"
                                    placeholder="Qidiruv..."
                                    value="{{ $query }}">
                            </form>
                        </div>
                        <a href="{{ route('dashboard.users.create') }}">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(session()->has('user.deleted'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('user.deleted') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session()->has('user.created'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('user.created') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Ism</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Ism</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>
                                    </th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1  }}
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->pluck('display_name')->join(' | ') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('dashboard.users.edit-view', ['id' => $user->id]) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                @if(!$user->roles->pluck('name')->contains('admin'))
                                                    <form
                                                        action="{{ route('dashboard.users.delete', ['id' => $user->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-link">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">{{ $users->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script>
        // $(document).ready(function () {
        //     $('#dataTable').DataTable();
        // });
    </script>
@endsection
