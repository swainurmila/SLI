@extends('admin.layouts.app')
@section('title','User Dashboard')
@section('subheading','edit user')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    User <span class="fw-300"><i>Edit</i></span>
                </h2>
                <div class="panel-toolbar">

                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <form action="{{route('user.update',[$id])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Name</label>
                            <input type="text" id="simpleinput" name="name" value="{{$user->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-email-2">Email</label>
                            <input type="email" id="example-email-2" value="{{$user->email}}" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-email-2">Assign Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="">select</option>
                                @foreach ($role as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-password">Password</label>
                            <input type="password" id="example-password" name="password" class="form-control" value="12345678">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-palaceholder">confirm password</label>
                            <input type="password" id="example-palaceholder" class="form-control" value="12345678" placeholder="placeholder">
                        </div>

                        <div class="form-group">
                            <button type="sumbit" class="btn btn-success waves-effect waves-themed">save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
