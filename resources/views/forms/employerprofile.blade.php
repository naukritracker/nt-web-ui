<div class="container pad-t85 mar-t20">
    <div class="row mar-b20">
        <form method="POST" action="{{  URL::route('SaveEmployerProfile') }}" enctype="multipart/form-data">
            <h3>Company Details</h3>
            <div class="col-sm-12">
                <div class="form-group @if ($errors->has('companyName')) error @endif">
                    <label for="companyName">Company Name</label>
                    <input type="text"
                           name="companyName"
                           class="form-control"
                           value="{{ Auth::user("employer")->employer->name }}"
                           placeholder="Company Name" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group @if ($errors->has('companyEmail')) error @endif">
                    <label for="companyEmail">Company Email</label>
                    <input type="text"
                           name="companyEmail"
                           class="form-control"
                           value="{{ Auth::user("employer")->employer->email }}"
                           placeholder="Company Email" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group @if ($errors->has('companyPhone')) error @endif">
                    <label for="companyPhone">Company Phone</label>
                    <input type="text"
                           name="companyPhone"
                           class="form-control"
                           value="{{ Auth::user("employer")->employer->phone }}"
                           placeholder="Company Phone" />
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group @if ($errors->has('companyAddress')) {{error}} @endif">
                    <label for="companyAddress">Company Address</label>
                    <textarea name="companyAddress"
                              class="form-control"
                              placeholder="Company Address">
                            {!! trim(Auth::user("employer")->employer->address) !!}
                    </textarea>
                </div>
            </div>
            <hr>
            <br>
            <h3>Administrator Access Details</h3>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="oldPassword">Password</label>
                    <input type="password"
                           name="oldPassword"
                           class="form-control"
                           placeholder="Current Password" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password"
                           name="newPassword"
                           class="form-control"
                           placeholder="New Password" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="newPassword">Confirm Password</label>
                    <input type="password"
                           name="newPassword_confirmation"
                           class="form-control"
                           placeholder="Confirm Password" />
                </div>
            </div>

            <div class="col-sm-12 text-center text-capitalize">
                <input type="submit" class="form-control btn-success" value="Update" />
            </div>
            {!! Form::token() !!}
        </form>
    </div>
</div>