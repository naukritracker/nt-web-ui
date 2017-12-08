{!! Form::open( ["class"=>"row pad-t10 pad-b10", "id"=> "education_form", "route"=>"SaveEducationDetails" ]) !!}


<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">


        <li role="presentation" class="active">
            <a href="#ed-ug" aria-controls="messages" role="tab" data-toggle="tab">Under Graduation</a>
        </li>
        <li role="presentation">
            <a href="#ed-pg" aria-controls="settings" role="tab" data-toggle="tab">Post Graduation</a>
        </li>
        <li role="presentation">
            <a href="#ed-other" aria-controls="settings" role="tab" data-toggle="tab">Certifications</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">


<?php
 $ending_year = date('Y', strtotime('+4 year'));
 ?>

        <div role="tabpanel" class="tab-pane active" id="ed-ug">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="">Basic/graduation<span class="error-text">*</span></label>


                        {!!Form::select('graduation',['B.A','B.Arch','B.Des','B.El.Ed','B.P.Ed','B.U.M.S','BAMS','B.B.A/ B.M.S','B.Com','B.Ed','BDS','BFA','BHM','B.Pharma','B.Sc','B.Tech/B.E.','BHMS','LLB','MBBS','Diploma','BVSC','Other'],Auth::user()->userdetail->graduation,['placeholder'=>'Select','class'=>'form-control'])!!}

                    <!-- <select class='form-control' name="graduation" >


                            <option value="0">Select</option>
                            <option value="1">Not Pursuing Graduation</option>
                            <option value="2">B.A</option>
                            <option value="3">B.Arch</option>
                            <option value="4">B.Des.</option>
                            <option value="5">B.El.Ed</option>
                            <option value="5">B.P.Ed</option>
                            <option value="7">B.U.M.S</option>
                            <option value="8">BAMS</option>
                            <option value="9">c</option>
                            <option value="10">B.B.A/ B.M.S</option>
                            <option value="11">B.Com</option>
                            <option value="12">B.Ed</option>
                            <option value="13">BDS</option>
                            <option value="14">BFA</option>
                            <option value="15">BHM</option>
                            <option value="16">B.Pharma</option>
                            <option value="17">B.Sc</option>
                            <option value="18" >B.Tech/B.E.</option>
                            <option value="19">BHMS</option>
                            <option value="20">LLB</option>
                            <option value="21">MBBS</option>
                            <option value="22">Diploma</option>
                            <option value="23">BVSC</option>
                            <option value="9999">Other</option>
                        </select>! -->
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Specialization <span class="error-text">*</span></label>
                        {!!Form::text('ug_specialization',Auth::user()->userdetail->ug_specialization,['placeholder'=>'Your Specialization','class'=>'form-control','required'])!!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Institution for Under Graduation<span class="error-text">*</span></label>
                        {!!Form::text('ug_institution',Auth::user()->userdetail->ug_institute,['placeholder'=>'Specify University/Institute','class'=>'form-control','required'])!!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Year<span class="error-text">*</span></label>
                        {!!  Form::selectRange('ug_year', $ending_year,1940,Auth::user()->userdetail->ug_year, ['class' => 'form-control', 'placeholder'=>'Passing year','required']) !!}
                    </div>
                </div>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane" id="ed-pg">
            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="">Post Graduation</label>


                        {!!Form::select('postgraduation',['CA','CS','DM','ICWA (CMA)','Integrated PG','LLM','M.A','M.Arch','M.Ch','M.Com','M.Des.','M.Ed','M.Pharma','MDS','MFA','MS/M.Sc(Science)','M.Tech','MBA/PGDM','MCA','Medical-MS/MD','PG Diploma','MVSC','MCM','Other'],Auth::user()->userdetail->post_graduation,['placeholder'=>'Select','class'=>'form-control'])!!}

                        <!--<select class='form-control' name="postgraduation" >

                            <option value="0" selected>Select</option>
                            <option value="1">CA</option>
                            <option value="2">CS</option>
                            <option value="3">DM</option>
                            <option value="4">ICWA (CMA)</option>
                            <option value="5">Integrated PG</option>
                            <option value="6">LLM</option>
                            <option value="7">M.A</option>
                            <option value="8">M.Arch</option>
                            <option value="9">M.Ch</option>
                            <option value="10">M.Com</option>
                            <option value="11">M.Des.</option>
                            <option value="12">M.Ed</option>
                            <option value="13">M.Pharma</option>
                            <option value="14">MDS</option>
                            <option value="15">MFA</option>
                            <option value="16">MS/M.Sc(Science)</option>
                            <option value="17">M.Tech</option>
                            <option value="18">MBA/PGDM</option>
                            <option value="19">MCA</option>
                            <option value="20">Medical-MS/MD</option>
                            <option value="21">PG Diploma</option>
                            <option value="22">MVSC</option>
                            <option value="23">MCM</option>
                            <option value="9999">Other</option>
                        </select>
                        </select>-->
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Specialization </label>
                        {!!Form::text('pg_specialization',Auth::user()->userdetail->pg_specialization,['placeholder'=>'Your Specialization','class'=>'form-control'])!!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Institution for post Graduation </label>
                        {!!Form::text('pg_institution',Auth::user()->userdetail->pg_institute,['placeholder'=>' University/Institute','class'=>'form-control'])!!}
                    </div>

                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Year</label>
                        {!!  Form::selectRange('pg_year', $ending_year,1940, Auth::user()->userdetail->pg_year, ['class' => 'form-control', 'placeholder'=>' Passing year']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="ed-other">


            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Certification Name </label>
                        {!!Form::text('certification_name',Auth::user()->userdetail->certification_name,['placeholder'=>'Certification Name','class'=>'form-control'])!!}
                    </div>

                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Certifiaction Body</label>
                        {!!Form::text('certification_body',Auth::user()->userdetail->certification_body,['placeholder'=>'Certifiaction Body','class'=>'form-control'])!!}
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row pad-t10">
                    <div class="form-group">
                        <label for="name">Year</label>
                        {!!  Form::selectRange('certification_year', $ending_year,1940,Auth::user()->userdetail->certification_year, ['class' => 'form-control', 'placeholder'=>'year']) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::hidden('progress_percentage', 20, ['class'=>'form-control','required']) !!}

<div class="col-xs-12 text-center pad-t40">
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save Education Details">

    </div>
</div>


{!! Form::token() !!}
{!! Form::close() !!}