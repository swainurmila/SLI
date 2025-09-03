<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">First Name:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="text" placeholder="First Name" name="first_name" value="{{@$userdata['first_name']}}">
                @error('first_name')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">Last Name:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="text" placeholder="Last Name" name="last_name" value="{{@$userdata['last_name']}}">
                @error('last_name')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">User Name:
                    <sup><span
                        style="color: red;">*</span></sup>
                </label>
                <input type="text" placeholder="User Name" name="user_name" value="{{@$userdata['user_name']}}">
                @error('user_name')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">Email:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="email" placeholder="Email" name="email" value="{{@$userdata['email']}}">
                @error('email')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">Phone Number:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="text" placeholder="Phone Number" name="contact_no" value="{{@$userdata['contact_no']}}">
                @error('contact_no')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">Current Password:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="password" placeholder="Current password" id="current_password" name="current_password">
                @error('current_password')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">New Password:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="password" placeholder="New Password" id="new_password" name="new_password">
                @error('new_password')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">Confirm New Password:<sup><span
                    style="color: red;">*</span></sup></label>
                <input type="password" placeholder="Confirm New Password" id="confirm_password" name="confirm_password">
                @error('confirm_password')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="dashboard__form__wraper">
            <div class="dashboard__form__input">
                <label for="#">Present Address:<sup><span
                    style="color: red;">*</span></sup></label>
                <textarea name="present_address" value={{@$userdata['present_address']}} id="" cols="5" rows="5">{{@$userdata['present_address']}}</textarea>
                @error('present_address')
                    <span>
                        <p class="text-danger">{{$message}}</p>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
