{!! Form::open(["class"=>"row pad-t10 pad-b10", "id"=> "change_password_form", "route"=>"SaveChangePassword"]) !!}
<div class="col-xs-12">
    <div class="row pad-t10">
        <div class="form-group">
            <label for="old_password">Old Password</label>
            {!! Form::password('old_password', ['class'=>'form-control', 'id'=>'old_password','placeholder'=>'Old Password']) !!}
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="row pad-t10">
        <div class="form-group">
            <label for="new_password">New Password</label>
            {!! Form::password('new_password', ['class'=>'form-control', 'id'=>'new_password','placeholder'=>'New Password']) !!}
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="row pad-t10">
        <div class="form-group">
            <label for="">Confirm New Password</label>
            {!! Form::password('new_password_confirmation', ['class'=>'form-control', 'id'=>'new_password_confirmation', 'placeholder'=>'Confirm New Password']) !!}
        </div>
    </div>
</div>

<div class="col-xs-12 text-center pad-t40">
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save New Password">
    </div>
</div>

{!! Form::token() !!}
{!! Form::close() !!}