{!! Form::open( ["class"=>"row pad-t10 pad-b10", "id"=> "education_form", "route"=>"SaveEducationDetails"]) !!}
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#ed-tenth" aria-controls="home" role="tab" data-toggle="tab">10<sup>th</sup></a>
        </li>
        <li role="presentation">
            <a href="#ed-twelth" aria-controls="profile" role="tab" data-toggle="tab">12<sup>th</sup></a>
        </li>
        <li role="presentation">
            <a href="#ed-ug" aria-controls="messages" role="tab" data-toggle="tab">Under Graduation</a>
        </li>
        <li role="presentation">
            <a href="#ed-pg" aria-controls="settings" role="tab" data-toggle="tab">Post Graduation</a>
        </li>
        <li role="presentation">
            <a href="#ed-other" aria-controls="settings" role="tab" data-toggle="tab">Other</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="ed-tenth">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="10_educational_institute_name">10<sup>th</sup>(or Equivalent) Grade  Institution</label>
                        {!! Form::text('10_educational_institute_name', $userdetail->sse_institution, ['class'=>'form-control','placeholder'=>'Institution']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="10_education_start_date">Start Year</label>
                        {!! Form::date('10_education_start_date', $userdetail->sse_start_date, ['class'=>'form-control','placeholder'=>'Start Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="10_education_end_date">End Year</label>
                        {!! Form::date('10_education_end_date', $userdetail->sse_end_date, ['class'=>'form-control','placeholder'=>'End Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="10_course">Major</label>
                        {!! Form::text('10_course', $userdetail->sse_type, ['class'=>'form-control','placeholder'=>'Course Type']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="ed-twelth">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="12_educational_institute_name">12<sup>th</sup>(or Equivalent) Grade Institution</label>
                        {!! Form::text('12_educational_institute_name', $userdetail->hsse_institution, ['class'=>'form-control','placeholder'=>'Institution']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="12_education_start_date">Start Year</label>
                        {!! Form::date('12_education_start_date', $userdetail->hsse_start_date, ['class'=>'form-control','placeholder'=>'Start Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="12_education_end_date">End Year</label>
                        {!! Form::date('12_education_end_date', $userdetail->hsse_end_date, ['class'=>'form-control','placeholder'=>'End Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="12_course">Major</label>
                        {!! Form::text('12_course', $userdetail->hsse_type, ['class'=>'form-control','placeholder'=>'Course Type']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="ed-ug">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="ug_educational_institute_name">Institution for Under Graduation</label>
                        {!! Form::text('ug_educational_institute_name', $userdetail->ug_institution, ['class'=>'form-control','placeholder'=>'Institution']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="ug_education_start_date">Start Year</label>
                        {!! Form::date('ug_education_start_date', $userdetail->ug_start_date, ['class'=>'form-control','placeholder'=>'Start Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="ug_education_end_date">End Year</label>
                        {!! Form::date('ug_education_end_date', $userdetail->ug_end_date, ['class'=>'form-control','placeholder'=>'End Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                       <label for="ug_course">Major</label>
                        {!! Form::text('ug_course', $userdetail->ug_type, ['class'=>'form-control','placeholder'=>'Course Type']) !!}
                    </div>
                </div>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane" id="ed-pg">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="pg_educational_institute_name">Institution for Post Graduation</label>
                    {!! Form::text('pg_educational_institute_name', $userdetail->pg_institution, ['class'=>'form-control','placeholder'=>'Institution']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="pg_education_start_date">Start Year</label>
                         {!! Form::date('pg_education_start_date', $userdetail->pg_start_date, ['class'=>'form-control','placeholder'=>'Start Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="pg_education_end_date">End Year</label>
                        {!! Form::date('pg_education_end_date', $userdetail->pg_end_date, ['class'=>'form-control','placeholder'=>'End Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="pg_course">Major</label>
                        {!! Form::text('pg_course', $userdetail->pg_type, ['class'=>'form-control','placeholder'=>'Course Type']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="ed-other">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="other_educational_institute_name">Institution</label>
                        {!! Form::text('other_educational_institute_name', $userdetail->other_institution, ['class'=>'form-control','placeholder'=>'Institution']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="other_education_start_date">Start Year</label>
                        {!! Form::date('other_education_start_date', $userdetail->other_start_date, ['class'=>'form-control','placeholder'=>'Start Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="other_education_end_date">End Year</label>
                        {!! Form::date('other_education_end_date', $userdetail->other_end_date, ['class'=>'form-control','placeholder'=>'End Year']) !!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="other_course">Major</label>
                        {!! Form::text('other_course', $userdetail->other_type, ['class'=>'form-control','placeholder'=>'Course Type']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 text-center pad-t40">
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save Education Details">
    </div>
</div>

{!! Form::token() !!}
{!! Form::close() !!}