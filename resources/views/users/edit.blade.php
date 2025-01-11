@extends('layouts.app')

@section('title', 'User Edit')

@section('content')
@include('shared.breadcrumb', [
'title' => 'User Edit',
'bc_data' => [
[
'link' => route('users.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => route('users.index'),
'text' => 'Users',
'is_active' => false
],
[
'link' => '',
'text' => 'Edit',
'is_active' => true
]
]
])
<div class="container-fluid">
    <div class="card">
        <div class="card-body p-3">
            <form action="{{ route('users.update', [$user->id]) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group form-group-sm  col-12 col-md-6">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control form-control-sm  @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group form-group-sm  col-12 col-md-6">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" class="form-control form-control-sm  @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group form-group-sm  col-12 col-md-6">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" id="password" class="form-control form-control-sm  @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group form-group-sm  col-12 col-md-6">
                    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" id="password_confirmation" class="form-control form-control-sm  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 mt-3 text-right">
                    <button type="button" class="btn btn-sm btn-cancel back">Cancel</button>
                    <button type="submit" class="submit-btn ml-2 btn btn-sm btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection