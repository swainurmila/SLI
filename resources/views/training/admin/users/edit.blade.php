@extends('training.admin.layouts.page-layouts.main')
@section('content')

@php
    $states = DB::table('states')->get();
    $cities = DB::table('cities')->where('state_id',Auth::user()->state_id)->get();

@endphp
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">User Edit</h4>
                            </div>
                            <form method="POST" action="{{ route('training.users.update',['id'=>@$user->id]) }}">
                                @method('PUT')
                                @csrf
                                <div class="mb-3 row">
                                    <div class="col-sm-12 col-lg-4">

                                        <label class="col-form-label" for="">First Name</label>
                                        <input type="text" class="form-control" value="{{@$user->first_name}}" name="first_name" id="first_name"
                                            placeholder="First Name">
                                        @error('first_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-lg-4">

                                        <label class="col-form-label" for="">Last Name</label>
                                        <input type="text" class="form-control"  value="{{@$user->last_name}}" name="last_name" id="last_name"
                                            placeholder="Last Name">
                                        @error('last_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label" for="">User Name</label>
                                        <input type="text" class="form-control" value="{{@$user->user_name}}" name="user_name" id="user_name"
                                            placeholder="User Name">
                                        @error('user_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-lg-4">

                                        <label class="col-form-label" for="">Email</label>
                                        <input type="mail" class="form-control" value="{{@$user->email}}" name="email" id="email"
                                            placeholder="Email">
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label" for="">Contact No</label>
                                        <input type="text" class="form-control" value="{{@$user->contact_no}}" name="contact_no" id="contact_no"
                                            placeholder="Contact No">
                                        @error('contact_no')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">State</label>
                                        <select class="form-select select2"  name="state_id" id="state_dropdown">
                                            @foreach ($states as $item)
                                                <option value="{{ $item->id }}" {{@$item->id == @$user->state_id ? 'selected' : ''}}>{{ $item->state_title }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('state_id')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">District</label>
                                        <select class="form-select select2" name="district_id" id="district_dropdown">
                                            <option value="">Select District</option>

                                            @foreach ($cities as $item)
                                                <option value="{{ $item->id }}" {{@$item->id == @$user->district_id ? 'selected' : ''}}>{{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        @error('district_id')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-lg-4">

                                        <label class="form-label" for="">Present Address</label>
                                        <textarea name="present_address" id="present_add" class="form-control" value={{@$user->present_address}}>{{@$user->present_address}}</textarea>
                                        @error('present_address')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-lg-4">

                                        <label class="form-label" for="">Permanent Address</label>
                                        <textarea name="permanent_address" id="permanent_address" class="form-control" value={{@$user->permanent_address}}>{{@$user->permanent_address}}</textarea>
                                        @error('permanent_address')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Password</label>
                                        <input class="form-control" name="password" type="text" value="" id="">
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{URL::previous()}}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection


@section('script')

<script>

    $('#paddress').click(function() {
        if ($('#paddress').is(':checked')) {
            let pre_add = $('#present_add').val();
            $('#permanent_add').val(pre_add);
        } else {
            $('#permanent_add').val('');
        }
    });
    $('#state_dropdown').on('change', function() {
        //alert(123);
        var state_id = this.value;
        $.ajax({
            url: "{{ url('/training/get_city') }}",
            type: "get",
            data: {
                state_id: state_id,
            },
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            dataType: 'json',
            success: function(result) {
                console.log(result)
                $('#district_dropdown').empty();
                $.each(result.city, function(key, value) {
                    $("#district_dropdown").append('<option value="' + value.id +
                        '">' + value.name + '</option>');
                });
            }
        });
    });
</script>
@endsection
