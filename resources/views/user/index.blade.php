@extends('layouts.partials.dashboard')

@section('content')
    <div class="container col-md-8 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="mb-0">Users Admin Room 911 List</h4>
                        <!-- Botón para agregar nuevo usuario -->
                        <div class="position-relative">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm position-absolute" style="top: 2px; right: 5px;">
                                Add New User
                            </a>
                        </div>
                    </div>

                    <div class="card-body py-4">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Document Number</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->document_number }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-center bg-light py-2">
                        {{ $users->links() }} <!-- Paginación si es necesario -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
