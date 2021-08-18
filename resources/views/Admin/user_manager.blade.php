@extends('admin_layout')
@section('admin_content')
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
        @if(session('danger'))
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    {{session('danger')}}
                </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">User Managerment</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Author</th>
                                <th scope="col">User</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $value)
                                <form action="{{route('assign_role')}}" method="POST">
                                    @csrf
                                    <tr>
                                        <th scope="row">{{$value->id}}
                                            <input type="hidden" name="user_id" value="{{$value->id}}">
                                        </th>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}
                                            <input type="hidden" name="user_email" value="{{$value->email}}"</input>
                                        </td>
                                        <td>{{$value->phone}}</td>
                                        <td>
                                            <input type="checkbox" name="adminCheck" {{$value->hasRole('admin') ? 'checked' : ''}}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="authorCheck" {{$value->hasRole('author') ? 'checked' : ''}}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="userCheck" {{$value->hasRole('user') ? 'checked' : ''}}>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-sm">Phân Quyền</button>
                                            <a class="btn btn-danger btn-sm" href="{{route('delete_user_role',$value->id)}}">Xóa</a>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav>{{$user->links()}}</nav>
                </div>
            </div>
        </div>
    </div>
@endsection


































































