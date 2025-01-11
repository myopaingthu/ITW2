@extends('layouts.app')

@section('title', 'User')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Users Management',
'bc_data' => [
[
'link' => route('users.index'),
'text' => 'Home',
'is_active' => false
],
[
'link' => route('users.index'),
'text' => 'Users',
'is_active' => true
]
]
])
<div class="container-fluid">
    <div class="text-right mb-2 mr-2">
        <a href="{{ route('users.create') }}" class="ml-2 btn btn-sm btn-primary">Create New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <input type="hidden" value="{{ route('users.index') }}" id="index_route">
                <table id="user_list" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection