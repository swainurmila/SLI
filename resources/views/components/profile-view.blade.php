<div class="mb-2 row">
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="">First Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-valid-save" name="first_name" id="first_name"
            placeholder="First Name" maxlength="15" onkeypress="return /[a-z A-Z\.]/i.test(event.key)" value="{{$profile['first_name']}}">
        @if ($errors->has('first_name'))
            <div class="error text-danger">{{ $errors->first('first_name') }}</div>
        @endif
    </div>
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="">Last Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-valid-save" name="last_name" id="last_name"
            placeholder="Last Name" maxlength="15" onkeypress="return /[a-z A-Z\.]/i.test(event.key)" value="{{$profile['last_name']}}">
        {{-- @if ($errors->has('last_name'))
            <div class="error">{{ $errors->first('last_name') }}</div>
        @endif --}}
    </div>
</div>
<div class="mb-2 row">
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control form-valid-save" name="password" id="password"
            placeholder="********">
        @if ($errors->has('password'))
            <div class="error text-danger">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="user_name">User Name</label>
        <input type="text" class="form-control form-valid-save" name="user_name" maxlength="15" id="user_name"
            onkeypress="return /[a-z A-Z\.]/i.test(event.key)" placeholder="User Name"
            value="{{ $profile['user_name'] }}">
        @if ($errors->has('user_name'))
            <div class="error text-danger">{{ $errors->first('user_name') }}</div>
        @endif
    </div>
</div>
<div class="mb-2 row">
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="">Contact No <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-valid-save" name="contact_no" id="contact_no"
            placeholder="Contact No" maxlength="10" value="{{ $profile['contact_no'] }}">
        @if ($errors->has('contact_no'))
            <div class="error text-danger">{{ $errors->first('contact_no') }}</div>
        @endif
    </div>
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="">Email</label>
        <input type="mail" class="form-control form-valid-save" name="email" id="email" placeholder="Email"
            value="{{ $profile['email'] }}" readonly>
        @if ($errors->has('email'))
            <div class="error text-danger">{{ $errors->first('email') }}</div>
        @endif
    </div>
</div>
<div class="mb-2 row">
    <div class="col-sm-12 col-lg-6">
        <label class="col-form-label">State</label>
        <select class="form-select add_state_dropdown" name="state_id">
            <option value="">Select</option>

            @foreach ($statesdata as $val)
                <option value="{{ $val->id }}" {{ $val->id == $profile['state_id'] ? 'selected' : '' }}>
                    {{ $val->state_title }}</option>
            @endforeach
        </select>
        @if ($errors->has('state_id'))
            <div class="error text-danger">{{ $errors->first('state_id') }}</div>
        @endif
    </div>
    <div class="col-sm-12 col-lg-6">
        <label class="col-form-label">District</label>
        <select class="form-select district_dropdown" name="district_id" id="district_id">
            <option value="">Select District</option>
            @foreach ($citiesdata as $val)
                <option value="{{ $val->id }}" {{ $val->id == $profile['district_id'] ? 'selected' : '' }}>
                    {{ $val->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('district_id'))
            <div class="error text-danger">{{ $errors->first('district_id') }}</div>
        @endif
    </div>
</div>
<div class="row mb-2">
    <div class="col-md-6">
        <label class="form-label" for="">Present Address</label>
        <textarea name="present_address" id="present_add" maxlength="40" class="form-control form-valid-save">{{$profile['present_address']}}</textarea>
        @if ($errors->has('present_address'))
            <div class="error text-danger">{{ $errors->first('present_address') }}</div>
        @endif
    </div>
    <div class="col-md-6">
        <label class="form-label" for="">Permanent Address</label>
        <textarea name="permanent_address" id="permanent_add" maxlength="40" class="form-control form-valid-save">{{$profile['permanent_address']}}</textarea>
        @if ($errors->has('permanent_address'))
            <div class="error text-danger">{{ $errors->first('permanent_address') }}</div>
        @endif
    </div>
</div>
<div class="row mb-2">
    <div class="col-sm-12 col-lg-6">
        <label class="form-label" for="">Upload Photo<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="profile_photo"
            id="profile_photo" accept=".jpg,.jpeg,.png" placeholder="">
        @if ($errors->has('profile_photo'))
            <div class="error text-danger">{{ $errors->first('profile_photo') }}</div>
        @endif
    </div>
    <div class="col-sm-12 col-lg-6">
        <img src="{{ asset($profile['profile_photo']) }}" style="height: 100px;width: 100px;">
    </div>

</div>
