@extends('layouts.partials.dashboard')

@section('content')
    <div class="container col-md-6 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="mb-0">Add New Admin Room 911</h4>
                    </div>

                    <div class="card-body py-4">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="first_name" class="font-weight-bold">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="font-weight-bold">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="document_number" class="font-weight-bold">Document Number</label>
                                <input type="text" name="document_number" class="form-control" id="document_number" placeholder="Enter Document Number" value="{{ old('document_number') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block font-weight-bold">Add User</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center bg-light py-2">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Back to Users List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
