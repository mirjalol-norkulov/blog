@extends('dashboard.layouts.base')

@section('title')
    Foydalanuvchilar
@endsection

@section('content')
    <div class="container mt-2" id="users-app">
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="mr-2">Foydalanuvchilar</span>
                            <form action="{{ route('dashboard.users.index') }}" method="get">
                                <input
                                    type="text"
                                    v-model="searchText"
                                    class="form-control"
                                    name="q"
                                    placeholder="Qidiruv..."
                                    v-debounce:300ms="handleInput"
                                >
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
                                <tr v-for="(user, i) in users.data">
                                    <td>
                                        @{{ getIndex(i) }}
                                    </td>
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>@{{ getRoleNames(user) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a :href="`/dashboard/users/${user.id}/edit`" class="btn">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <form
                                                :action="`/dashboard/users/${user.id}`"
                                                method="post"
                                                @submit.prevent="handleDelete(user)">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
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
        window.users = JSON.parse(`{!! json_encode($users) !!}`)
        window.query = `{{$query}}`
    </script>
    <script src="{{ asset('js/dashboard/users/users.js') }}"></script>
@endsection
