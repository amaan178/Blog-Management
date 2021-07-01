@extends('layouts.admin-panel.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Users</h2>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Post Count</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><img src="{{ $user->gravatar_image }}" width="120"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->posts->count() }}</td>
                    <td>
                        @if(! $user->isAdmin())
                            <form action="{{route('users.make-admin', $user->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-success">Make Admin</button>
                            </form>
                        @else
                            <form action="{{route('users.revoke-admin', $user->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Revoke Admin</button>
                            </form>
                        @endif
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id = "deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="deletePost" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    {{ $users->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection

