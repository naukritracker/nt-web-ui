<div class="clearfix">
    <div class="row" id="hhk">
        {!! Form::open([ "id"=>"add-exp-form", "route" => "AddExp", "files"=>"true",'onsubmit'=>'pos();']) !!}
      
	  
	<!--  <div class="form-group">
                    <div class="clearfix">
                        <label for="">Are you a Fresher? <span class="error-text">*</span></label>
                        <label class="radio-inline">
                            <input type="radio" name="yesno" id="yesCheck"  value="yes"  onclick="yesnoCheck();"> Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="yesno" id="noCheck" value="no"  onclick="yesnoCheck();"> No
                        </label>

                    </div>
                        <div class="col-sm-12">
                            <hr class="c-hr">
                        </div>
                    </div> -->
 <!--<div id="ifYes"  style="display: none;">	-->
      
                    <div class="form-group">
                        <label for="">Current Employer </label>
                        {!!Form::text('company',Auth::user()->userdetail->current_employer,['placeholder'=>'Your current employer','class'=>'form-control','id'=>'register_company'])!!}
                    </div>

					
					<?php
 $ending_year = date('Y', strtotime('+4 year'));
 ?>		
<div class="form-group">
                        <label for="">Duration </label>
                    </div>


    

                  <div class="row hmar5">
                            <div class="form-group col-sm-6 hpad5">
                                <div class="form-group">
								
			{!!Form::select('c_f_month',['January','February','March','April','May','June','July','August','September','October','November','December'],Auth::user()->userdetail->c_f_month,['placeholder'=>'Select Month','class'=>'form-control'])!!}
								
                                    </div>
                            </div>
                            <div class="form-group col-sm-6 hpad5">
                                <div class="form-group">
						{!!  Form::selectRange('c_f_year', $ending_year,1940,Auth::user()->userdetail->c_f_year, ['class' => 'form-control', 'placeholder'=>'Select Year']) !!}

                                    </div>
                            </div>
                        </div>		


                    <div class="row-fluid">

                        <div class="span12 text-center">

                            to

                        </div>

                    </div>




                    <input
                            type="text"
                            name="experience_end_date"
                            class="form-control fresher"
                            value="present"
                            id="experience_end_date"
                            readonly

                    />
 <br>
                    <div class="form-group">
                        <label for="">Designation</label>
                        {!!Form::text('designation',Auth::user()->userdetail->designation,['placeholder'=>'Your full designation','class'=>'form-control','id'=>'employee_designation'])!!}
                    </div>

                    <div class="content-holder" id="pervious_emp"  >

                        <a href="#" class="expand-content-link" onclick="expand()">+Add Prevoius Employer</a>
                        <div class="hidden-content" style="display:none;">
                            <div class="col-sm-12">
                                <hr class="c-hr">
                            </div>
                            <div class="form-group" >
                                <label for="">Previous Employer </label>
                                {!!Form::text('previous_company',Auth::user()->userdetail->prev_company,['placeholder'=>'Prevoius Employer Name','class'=>'form-control'])!!}
                            </div>

                            <div class="form-group">
                                <label for="">Duration </label>
                            </div>
			
	
							
		

 <div class="row hmar5">
                            <div class="form-group col-sm-6 hpad5">
                                <div class="form-group">
								{!!Form::select('p_f_month',['January','February','March','April','May','June','July','August','September','October','November','December'],Auth::user()->userdetail->p_f_month,['placeholder'=>'Select Month','class'=>'form-control'])!!}
                                    </div>
                            </div>
                            <div class="form-group col-sm-6 hpad5">
                                <div class="form-group">
						{!!  Form::selectRange('p_f_year', $ending_year,1940,Auth::user()->userdetail->p_f_year, ['class' => 'form-control', 'placeholder'=>'Select Year','id'=>'gy2','onchange'=>'ychange(this);']) !!}

                                    </div>
                            </div>
                        </div>		
							
					 <div class="row-fluid">

                        <div class="span12 text-center">

                            to

                        </div>

                    </div>
		
					<div class="row hmar5">
                            <div class="form-group col-sm-6 hpad5">
                                <div class="form-group">
								{!!Form::select('p_t_month',['January','February','March','April','May','June','July','August','September','October','November','December'],Auth::user()->userdetail->p_t_month,['placeholder'=>'Select Month','class'=>'form-control'])!!}
                                    </div>
                            </div>
                            <div class="form-group col-sm-6 hpad5">
                                <div class="form-group">
						{!!  Form::selectRange('p_t_year', $ending_year,1940,Auth::user()->userdetail->p_t_year, ['class' => 'form-control', 'placeholder'=>'Select Year','id'=>'gy1']) !!}

                                    </div>
                            </div>
                        </div>		
									
 

                           


                            


                           

                         
                            <div class="form-group">
                                <label for="">Designation</label>
                                {!!Form::text('prev_designation',Auth::user()->userdetail->prev_designation,['placeholder'=>'Your full designation','class'=>'form-control'])!!}
                            </div>
                            <div class="col-sm-12">
                                <hr class="c-hr">
                            </div>

                        </div>
                    </div>
					 <div class="form-group">
                        <label for="">Annual Salary </label>
                    </div>
                    <div class="row hmar5">
                        <div class="form-group col-sm-6 hpad5">
                            <div class="input-group">
                                {!!Form::select('annual_lakh',$annual_lakh_options,Auth::user()->userdetail->annual_lakh,['placeholder'=>'Lakh(s)','class'=>'form-control'])!!}
                                <div class="input-group-addon c-add-on">Lakhs</div></div>
                        </div>
                        <div class="form-group col-sm-6 hpad5">
                            <div class="input-group">
                                {!!Form::select('annual_thousand',$annual_thousand_options,Auth::user()->userdetail->annual_thousand ,['placeholder'=>'Thousand(s)','class'=>'form-control'])!!}
                                <div class="input-group-addon c-add-on">Thousands</div></div>
                        </div>
                    </div>
					
					 <div class="clearfix">
                        <label class="radio-inline">
                            <input type="radio" name="currency" id="inlineRadio1" value="AED" class="fresher"> UAE Currency
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="currency" id="inlineRadio2" value="USD" class="fresher"> US Currency
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="currency" id="inlineRadio3" value="RUP" class="fresher"checked="checked"> Indian Currency
                        </label>
                    </div>
                    <br>
					
					  <div class="form-group">
                            <label for="">Total Experience <span class="error-text">*</span></label>
                        </div>
                        <div class="row hmar5">
                            <div class="form-group col-sm-6 hpad5">
                                <div class="input-group">
                                    {!!Form::select('total_years',['Fresher',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,'30+'],Auth::user()->userdetail->total_years,['placeholder'=>'Year(s)','class'=>'form-control','required'])!!}
                                    <div class="input-group-addon c-add-on">Years</div></div>
                            </div>
                            <div class="form-group col-sm-6 hpad5">
                                <div class="input-group">
                                    {!!Form::select('total_months',['Fresher',1,2,3,4,5,6,7,8,9,10,11],Auth::user()->userdetail->total_months,['placeholder'=>'Month(s)','class'=>'form-control','required'])!!}
                                    <div class="input-group-addon c-add-on">Months</div></div>
                            </div>
                        </div>
						
			<!--</div>	-->
  <!--<div id="Cars2">-->
 <div class="form-group">
                        <label for="">Key Skills <span class="error-text">*</span></label>
                        {!!Form::text('key_skills',Auth::user()->userdetail->key_skills,['placeholder'=>'key skills','class'=>'form-control ','required'])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Job Profile <span class="error-text">*</span></label>
						 {!!Form::textarea('employement_description',Auth::user()->userdetail->description,['placeholder'=>'Provide a description of your employment','class'=>'form-control', 'rows'=>'2','required'])!!}
                       <!--<textarea class="form-control" id="employement_description" name="employement_description" placeholder="Provide a description of your employment" rows="2"></textarea>-->
                    </div>
                    <div class="clearfix">      
					 <div class="form-group">
                    <label for="industry">Industry <span class="error-text">*</span></label>
                    {!! Form::select('industry', $selectindustry, Auth::user()->userdetail->emp_industry, ['placeholder'=>'Select industry', 'class'=>'form-control', 'id'=>'industry','required']) !!}
                </div>
					 <div class="form-group">
                    <label for="functional_area">Functional Area<span class="error-text">*</span> </label>
                    {!! Form::select('functional_area', $selectfunctional,  Auth::user()->userdetail->emp_functional_area, ['placeholder'=>'Select functional area', 'class'=>'form-control', 'id'=>'functional_area','required']) !!}
                </div>
					
					
       </div>


        {!! Form::hidden('progress_percentage', 30, ['class'=>'form-control','required']) !!}

        <hr>
        <div  class="col-xs-12 text-center">
              <button type="submit" class="btn btn-lg btn-success" id="sub" >Save Experience</button>
        </div>
   <!-- </div>-->
</div>
{!! Form::token() !!}
{!! Form::close() !!}
