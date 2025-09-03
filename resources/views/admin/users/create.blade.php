@extends('admin.layouts.app')
@section('title','User Dashboard')

@section('subheading','create user')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    User <span class="fw-300"><i>Create</i></span>
                </h2>
                <div class="panel-toolbar">

                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <form action="{{route('user.store')}}">
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Name</label>
                            <input type="text" id="simpleinput" name="name" value="" class="form-control border-info" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-email-2">Email</label>
                            <input type="email" id="example-email-2" value="" name="email" class="form-control border-info" placeholder="Email">
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
                            <input type="password" name="password" id="example-password" class="form-control border-info" placeholder="Password" >
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-palaceholder">confirm password</label>
                            <input type="password" id="example-palaceholder" name="cpass" class="form-control border-info" value="" placeholder="confirm password" >
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
