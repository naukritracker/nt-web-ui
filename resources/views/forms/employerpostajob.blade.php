@if($job)
    @if($formtype == 'edit')
        {!! Form::open(['route'=>['DoEmployersPostAJob', $job->id],'id'=>'employers_add_jobposting_form'])  !!}
    @else
        {!! Form::open(['route'=>['DoEmployersPostAJob'],'id'=>'employers_add_jobposting_form'])  !!}
    @endif
@else
    {!! Form::open(['route'=>'DoEmployersPostAJob','id'=>'employers_add_jobposting_form'])  !!}
@endif
<fieldset>
    <div class="clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                @if($job)
                    {!! Form::text('title', $job->title, ['placeholder'=>'Title', 'class'=>'form-control', 'id'=>'title', 'required']) !!}
                @else
                    {!! Form::text('title', null, ['placeholder'=>'Title', 'class'=>'form-control', 'id'=>'title', 'required']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                @if($job)
                    {!! Form::text('role', $job->role, ['placeholder'=>'Role (Designation)', 'class'=>'form-control', 'required']) !!}
                @else
                    {!! Form::text('role', null, ['placeholder'=>'Role (Designation)', 'class'=>'form-control', 'required']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                @if($job)
                    {!! Form::number('open_positions', $job->open_positions, ['placeholder'=>'No of open positions', 'class'=>'form-control']) !!}
                @else
                    {!! Form::number('open_positions', null, ['placeholder'=>'No of open positions', 'class'=>'form-control']) !!}
                @endif
            </div>
        </div>


        <div class="col-sm-6">
            <div class="form-group">
                @if($job)
                    {!! Form::select('minimum_education', $minimum_education, $job->minimum_education, ['placeholder'=>'Minimum education', 'class'=>'form-control', 'required']) !!}
                @else
                    {!! Form::select('minimum_education', $minimum_education, null, ['placeholder'=>'Minimum education', 'class'=>'form-control', 'required']) !!}
                @endif
                </div>
            </div>


        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    {!! Form::select('minimum_experience', $minimum_experience, $job->minimum_experience, ['placeholder'=>'Minimum experience', 'class'=>'form-control', 'required'])  !!}
                @else
                    {!! Form::select('minimum_experience', $minimum_experience, null, ['placeholder'=>'Minimum experience', 'class'=>'form-control', 'required'])  !!}
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <?php
                    $updatedselectstatesall = $selectstatesall;
                    $updatedselectstatesall[0] = 'Not Specified';
                    if ($job) {
                        Form::select('work_locations[]', $updatedselectstatesall, explode('||', $job->job_locations), ['placeholder'=>'Select one or multiple work locations(s)', 'class'=>'form-control','id'=>'work_locations','multiple']);
                    } else {
                        Form::select('work_locations[]', $updatedselectstatesall, null, ['placeholder'=>'Select one or multiple work locations(s)', 'class'=>'form-control','id'=>'work_locations','multiple']);
                    }
                ?>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="col-xs-5">
                <div class="form-group">
                    <label>Salary in AED</label>
                    @if($job)
                        {!! Form::number('salary_range_start', $job->salary_range_start, ['placeholder'=>'Start Range', 'class'=>'form-control'])  !!}
                    @else
                        {!! Form::number('salary_range_start', null, ['placeholder'=>'Start Range', 'class'=>'form-control'])  !!}
                    @endif
                </div>
            </div>
            <div class="col-xs-2 text-center">
                 to
            </div>
            <div class="col-xs-5">
                <div class="form-group">
                    <label>Salary in AED</label>
                    @if($job)
                        {!! Form::number('salary_range_end', $job->salary_range_end, ['placeholder'=>'End Range', 'class'=>'form-control']) !!}
                    @else
                        {!! Form::number('salary_range_end', null, ['placeholder'=>'End Range', 'class'=>'form-control']) !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <?php
                    $preferred_nationality['any_arabic_national'] = 'Any Arabic National';
                    $preferred_nationality['any_gcc_national'] = 'Any GCC National';
                    $preferred_nationality['any_european_national'] = 'Any European National';
                    $preferred_nationality['any_anglophone_national'] = 'Any Anglophone National';
                    $preferred_nationality['any_cis_national'] = 'Any CIS National';
                    foreach ($selectcountry as $id => $country) {
                        $preferred_nationality[$id] = $country;
                    }
                    if ($job) {
                        Form::select('preferred_nationality[]', $preferred_nationality, explode('||', $job->preferred_nationality), ['placeholder'=>'Select preferred nationality', 'class'=>'form-control','id'=>'preferred_nationality','multiple']);
                    } else {
                        Form::select('preferred_nationality[]', $preferred_nationality, null, ['placeholder'=>'Select preferred nationality', 'class'=>'form-control','id'=>'preferred_nationality','multiple']);
                    }
                ?>
                </div>
            </div>

        <div class="col-sm-6">
            <div class="form-group">
                @if($job)
                    {!! Form::select('job_type', $selectjobtype, $job->job_type, ['placeholder'=>'Select job type', 'class'=>'form-control']) !!}
                @else
                    {!! Form::select('job_type', $selectjobtype, null, ['placeholder'=>'Select job type', 'class'=>'form-control']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                @if($job)
                    {!! Form::select('employment_type', $selectemploymenttype, $job->employment_type, ['placeholder'=>'Select employment type', 'class'=>'form-control']) !!}
                @else
                    {!! Form::select('employment_type', $selectemploymenttype, null, ['placeholder'=>'Select employment type', 'class'=>'form-control']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    {!! Form::select('gender_type', $selectgendertype, $job->gender_type, ['placeholder'=>'Select gender type', 'class'=>'form-control']) !!}
                @else
                   {!! Form::select('gender_type', $selectgendertype, null, ['placeholder'=>'Select gender type', 'class'=>'form-control']) !!}
                @endif
            </div>
        </div>
<div>
        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
					
				
				<select class="form-control" name="country_id" id="country_id"  >
                                <option value="ChooseCountry" selected>Choose Country</option>
                                <option value="UAE">UAE</option>
                                <option value="SaudiArabia" >Saudi Arabia</option>
                                <option value="Oman" >Oman</option>
                                <option value="Qatar" >Qatar</option>
                                <option value="Kuwait" >Kuwait</option>
                                <option value="Bahrain" >Bahrain</option>
                              
                            </select>
                    
                @else
                    <select class="form-control" name="country_id" id="aa"  >
                                <option value="ChooseCountry" selected>Select Country</option>
                                <option value="UAE">UAE</option>
                                <option value="SaudiArabia" >Saudi Arabia</option>
                                <option value="Oman" >Oman</option>
                                <option value="Qatar" >Qatar</option>
                                <option value="Kuwait" >Kuwait</option>
                                <option value="Bahrain" >Bahrain</option>
                              
                            </select>
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
			
			<select   name="state_id" placeholder=" Select city/state" class="form-control" id="bb">
  </select>
                
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
			<select id="cc"  name="visa[]" placeholder="Select visa" class="form-control" >
  </select>
                
            </div>
        </div>
<script>
		var cityMapping = {
  ChooseCountry:["City"],	
  UAE: ["Abu Dhabi", "Ajman", "Dubai","Fujairah","Sharjah","Umm Al Qaiwain"],
  SaudiArabia: ["Riyadh", "Jeddah", "Mecca","Al Madinah","Al-Ahsa","Ta'if","Dammam/Khobar","Buraidah","Tabuk"],
  Oman: ["Muscat", "Zufar"],
  Qatar: ["Doha"],
  Kuwait: ["Al Ahmadi", "Al Farwaniyah", "Al Jahra","Kuwait City","Hawally"],
  Bahrain: ["Manama"]
}	


var visaMapping = {
  ChooseCountry:["Visa"],
  UAE: ["Employment Visa", "Employment Visa - Cancelled", "Family Sponsorship Visa","Long Term Visit - 90days","Tourist Visa - 30days","Mission Visa"],
  SaudiArabia: ["Business Visa - 180 Days", "Employment Visa - Transferable", "Employment Visa - Non-Transferable","Family Sponsorship Visa"],
  Oman: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"],
  Qatar: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"],
  Kuwait: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"],
  Bahrain: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"]
}		
	
	$('#aa').change(function() {
  // get the second dropdown
  $('#bb').html(
      // get array by the selected value
      cityMapping[this.value]
      // iterate  and generate options
      .map(function(v) {
        // generate options with the array element
        return $('<option/>', {
          value: v,
          text: v
        })
      })
    )
  
  $('#cc').html(
      // get array by the selected value
      visaMapping[this.value]
      // iterate  and generate options
      .map(function(v) {
        // generate options with the array element
        return $('<option/>', {
          value: v,
          text: v
        })
      })
    )
    // trigger change event to generate second select tag initially
}).change()
</script>

</div>
        <div class="col-xs-12 text-center">
            <div class="form-group">
                @if($job)
                    {!! Form::select('industry', $selectindustry, $job->industry, ['placeholder'=>'Select industry','class'=>'form-control','id'=>'industry']) !!}
                @else
                    {!! Form::select('industry', $selectindustry, null, ['placeholder'=>'Select industry','class'=>'form-control','id'=>'industry']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    {!! Form::select('company', $selectcompany, $job->company_id, ['placeholder'=>'Select employer','class'=>'form-control','id'=>'company','required']) !!}
                @else
                    {!! Form::select('company', $selectcompany, null, ['placeholder'=>'Select employer','class'=>'form-control','id'=>'company','required']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    {!! Form::text('apply_url', $job->apply, ['placeholder'=>'Add a URL for apply now button', 'class'=>'form-control','id'=>'apply']) !!}
                @else
                    {!! Form::text('apply_url', null, ['placeholder'=>'Add a URL for apply now button', 'class'=>'form-control','id'=>'apply']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <div class="checkbox">
                    @if($job)
                        @if($job->walkin)
                            <label> <input type="checkbox" name="walkin" value="1" checked="checked">Mark Job Posting as Walk In Type</label>
                        @else
                            <label> <input type="checkbox" name="walkin" value="1">Mark Job Posting as Walk In Type</label>
                        @endif
                    @else
                        <label> <input type="checkbox" name="walkin" value="1">Mark Job Posting as Walk In Type</label>
                    @endif
                </div>
            </div>
        </div>


        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    {!! Form::text('short_description', $job->short_description, ['placeholder'=>'Enter a short description', 'class'=>'form-control', 'id'=>'short_description', 'required']) !!}
                @else
                    {!! Form::text('short_description', null, ['placeholder'=>'Enter a short description', 'class'=>'form-control', 'id'=>'short_description', 'required']) !!}
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    <textarea class="form-control click-to-empty" name="description" placeholder="Provide description" required rows="1">{{ $job->description }}</textarea>
                @else
                    <textarea class="form-control click-to-empty" name="description" placeholder="Provide description" required rows="1">Provide longer description</textarea>
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                @if($job)
                    <textarea class="form-control click-to-empty" name="requirements" placeholder="Provide requirements" required rows="1">{{ $job->requirements }}</textarea>
                @else
                    <textarea class="form-control click-to-empty" name="requirements" placeholder="Provide requirements" required rows="1">Provide some requirements</textarea>
                @endif
                </div>
            </div>

        </div>

        <div class="col-xs-12 text-center">
            @if ($job)
                @if($formtype == 'edit')
                    <input type="submit" class="btn btn-primary" name="save" value="Update Job">
                @else
                    <input type="submit" class="btn btn-primary" name="save" value="Create new Job">
                @endif
            @else
                <input type="submit" class="btn btn-primary" name="save" value="Add Job">
            @endif
        </div>

    </div>

</fieldset>

{!! Form::token() !!}
{!! Form::close() !!}


