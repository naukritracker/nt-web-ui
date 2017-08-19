@extends('templates.client.master')

@section('title')
	Job Search - Naukri Tracker
@stop

@section('meta')
  @parent
  <meta name="keywords" content="Naukri Tracker - Job search results {{ isset($availablejobs) ? ' : '.$availablejobs.' Job(s) Available' : ''}}">
  <meta name="description" content="Naukri Tracker,Job search results for your dream job, Jobs found in @foreach($data['jobs'] as $job) @if($job->state) {{$job->state->state}}({{$job->country->country}}),@endif @endforeach">
  <meta name="robots" content="index/follow">
@stop

@section('css')
  @parent
  {!!Html::style('assets/jquery-ui-1.11.4.custom/jquery-ui.min.css')!!}
@stop

@section('content')
<section class="pad-t85 l-gray-box mar-b20 animated fadeInDown">
<div class="container">
	<div class="row os-h-search hmar5 mar-t20">
    {!!Form::open(array('route'=>'SearchForJobs','id'=>'search_jobs_form'))!!}
        <div class="col-sm-6 col-sm-offset-2 hpad5"><input type="text" name="search_value" @if(isset($search_value))  value="{{ $search_value }}" @endif class="form-control" placeholder="Search by Skills, Designation, Companies" required></div>
        <div class="col-sm-2 hpad5"><input type="submit" class="btn btn-primary btn-block" value="Search"></div>
        <input type="hidden" name="location_list" id="location_list" value="{{ isset($location_list) ? $location_list : '' }}"/>
        <input type="hidden" name="industry_list" id="industry_list" value="{{ isset($industry_list) ? $industry_list : '' }}"/>
        <input type="hidden" name="company_list" id="company_list" value="{{ isset($company_list) ? $company_list : '' }}"/>
        <input type="hidden" name="salary_range_start" id="salary_range_start" value="{{ isset($salary_range_start) ? $salary_range_start : '' }}"/>
        <input type="hidden" name="salary_range_end" id="salary_range_end" value="{{ isset($salary_range_end) ? $salary_range_end : '' }}"/>
        <input type="hidden" name="salary_start" id="salary_start" value="{{ isset($salary_start) ? $salary_start : '' }}"/>
        <input type="hidden" name="walkin" id="walkin" value="{{ isset($walkin) ? $walkin : '' }}"/>

        <input type="hidden" name="salary_end" id="salary_end" value="{{ isset($salary_end) ? $salary_end : '' }}"/>
    {!!Form::token()!!}
    {!!Form::close()!!}
    </div>
</div>
</section>
{!!Form::open(array('id'=>'k'))!!}
<div class="container">
  <div class="row mar-b20">
    <div class="col-sm-3 animated fadeInLeft">

        <h4 class="sm-title  mar-t10">Filter By <span id="activatefilternow" class="pull-right"></span></h4>


        <ul class="lhs-nav filter-block">
            <input type="hidden" id="searchjobsdata" value="{{URL::route('LoadSearchJobsFilterData')}}">
            <li><a href="javascript:void(0)" >Location</a></li>               
             <div class="pad-l20 filter-div" id="user-box"></div>

            <li ><a href="javascript:void(0)" >Industry</a></li>
             <div class="pad-l20 filter-div" id="industry-box"></div>

            <li><a href="javascript:void(0)">Salary in AED</a></li>

             <div class="pad-l20 filter-div">
                  <div class="pad20">
                    <div class="filterrange"></div>
                  </div>
                  <div class="checkbox" id="salary_range_display"></div> 
              </div>

            <li><a href="javascript:void(0)">Company</a></li>
             <div class="pad-l20 filter-div" id="company-box"></div>

             <li><a href="javascript:void(0)">Walk In</a></li>
              <div class="pad-l20 filter-div" id="company-box">
                 <div class="checkbox">
                    <label>
                      <input type="checkbox" class="walkin-check" value="1" data-id="1" id="walkin-check"> All Walk Ins 
                    </label>
                  </div>                                           
              </div>       
        </ul>

        <btn class="btn-facebook"><input type="reset" id="k" value="Reset Filters" onclick=clicker();></btn>

    </div>
      <div>
          <button class="btn btn-instagram"><a href="{{ route('Home')  }}">home</a></button>
      </div>
    <div class="col-sm-9">
          @if(count($data['jobs']) > 0)
           <div class="clearfix  animated fadeInUp">
               <h4 class="sm-title mar-t10 pull-left mar-b15">{{ isset($availablejobs) ? ''.$availablejobs.' Job(s) Available' : ''}}</h4>
               <div class="pull-right form-inline mar-b15">
                   <p class="pull-left mar-r10 mar-t5">Sort by&nbsp;:&nbsp;</p>
                   <select class="form-control pull-left" id="sortbyselection">
                       <option value="open_positions" @if(isset($order) && $order=='open_positions') selected @endif>Relevance</option>
                       <option value="updated_at" @if(isset($order) && $order=='updated_at') selected @endif>Date</option>
                       <option value="salary_range_start" @if(isset($order) && $order=='salary_range_start') selected @endif>Salary</option>
                   </select>
               </div>
           </div>
           <div class="row">
            <ul class="l-jobs animated fadeInUp">
            	@foreach($data['jobs'] as $job)
                <li>
                    <div class="row">
                      <p>
                        <!-- @if(Auth::user()) <a href="#" class="btn btn-default pull-right">Apply</a>@endif -->
                        @if($job->walkin == 1)  
                          <a href="javascript:void(0)" class="btn btn-sm btn-default pull-right">Walk In</a> 
                        @else
                          @if(Auth::user())
                            @if($job->apply != '')
                              <a href="{{ URL::route('RegisterJobApplication',[$job->id, $job->apply]) }}" target="_blank" class="btn btn-sm btn-default pull-right">Apply Now</a>
                            @endif
                          @endif
                        @endif 
                        <a href="{{URL::route('JobDetails',array($job->id))}}" class="sm-title"> {{$job->title}} </a> 
                      </p>
                      <p class="xs-title lj-icons">
                          @if($job->industry)
                              <span>{{$job->industry}}</span>
                          @endif

                          @if($job->state_id!=0)
                              <span>{{$job->state->state}} / {{$job->country->country}}</span>
                          @endif

                          @if($job->updated_at)
                              <span>{{$job->updated_at->diffForHumans()}}</span>                            
                          @endif                            
                      </p>
                      <div class="lj-description" id="jobdescription_{{$job->id}}">
                        <p>{{$job->short_description}}</p>
                        @if(Auth::user())<p><a href="javascript:void(0)" class="label label-info joblisting" id="{{$job->id}}">More Details <i class="fa fa-caret-down"></i></a></p>@endif
                      </div>
                      <div class="lj-details" id="jobdetails_{{$job->id}}" style="font-size:12px;color:#9d9da3;display:none">
                        <p>{{$job->short_description}}</p>
                        <div class="row">
                        @if($job->salary_range_start != 0)
                            <span class="col-xs-3" title="Salary Offered"><i class="fa fa-money"></i> {{$job->salary_range_start}} @if($job->salary_range_end != 0) - {{$job->salary_range_end}} @endif</span>
                        @endif
                        @if($job->role != NULL || $job->role != '')
                            <span class="col-xs-3" title="Role Specified"><i class="fa fa-user"></i> {{$job->role}}</span>
                        @endif
                        @if($job->visa != '' && $job->visa != 0)
                            <span class="col-xs-3" title="Visa Type"><i class="fa fa-certificate"></i> 
                            <?php
                              $visaNamesArray = array();
                              $visaArray = explode('||',$job->visa);
                              foreach ($visaArray as $visa) {
                                $visaNamesArray[] = $job->getVisaName($visa);
                              }
                            ?>
                            {{implode(',',$visaNamesArray)}}</span>
                        @endif
                        @if(strtotime($job->updated_at) > 0)
                            <span class="col-xs-3" title="Last Updated"><i class="fa fa-clock-o"></i> {{$job->updated_at->diffForHumans()}}</span>
                        @endif
                        </div>

                        <div class="container pad-t40" style="padding-left:35%">
                          <!-- AddToAny BEGIN -->
                          <div class="a2a_kit a2a_default_style">
                            <!-- <span class="a2a_divider"></span> -->
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_google_plus"></a>
                            <a class="a2a_button_email"></a>
                            <a class="a2a_button_linkedin"></a>
                          </div>
                          <script type="text/javascript">
                            var a2a_config = a2a_config || {};
                            a2a_config.linkname = "{{$job->title}} :\n{{$job->short_description}}\n";
                            a2a_config.linkurl = "{!!Request::url()!!}";
                            a2a_config.color_main = "D7E5ED";
                            a2a_config.color_border = "AECADB";
                            a2a_config.color_link_text = "333333";
                            a2a_config.color_link_text_hover = "333333";
                          </script>
                          <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
                          <!-- AddToAny END -->
                        </div>
                        
                        <p><br><a href="javascript:void(0)" class="label label-warning jobhiding" data-hide="{{$job->id}}">Hide Details <i class="fa fa-caret-up"></i></a></p>

                      </div>
                    </div>
                </li>
                @endforeach
                                                                                                                                     
            </ul> 
            </div>
            <div class="clearfix"></div>
            <div class="row">
              {!! $data['jobs']->appends(['location_list' => isset($location_list) ? $location_list : '','industry_list' => isset($industry_list) ? $industry_list : '','salary_range' => isset($salary_range) ? $salary_range : '','salary_start' => isset($salary_start) ? $salary_start : '','salary_end' => isset($salary_end) ? $salary_end : '','company_list' => isset($company_list) ? $company_list : '','order' => isset($order) ? $order : '','walkin' => isset($walkin) ? $walkin : ''])->render() !!} 
            </div>
                        
            @else
            <div class="clearfix  animated rotateInUpLeft">
              <h3 class="mar-t10 mar-b15 error-text"><i class="fa fa-times-circle-o"></i>  No jobs listed at present</h3>
              <p>Any and all oppurtunities will be listed here once they pass our <b>verification protocols</b>. This message is being displayed to you as our team is still reviewing the latest oppurtunities that have been listed with us.</p>
              <p><i>Thank You for your patience</i></p>
              <p><i>Sincerely</i></p>
              <p><i><b>Naukri Tracker</b></i></p>
              
            </div>
            @endif
    </div>
                              
  </div>
</div>

@stop
{!!Form::token()!!}
{!!Form::close()!!}
@section('js')
	@parent
  {!! Html::script('assets/js/slick.min.js') !!}
  {!! Html::script('assets/jquery-ui-1.11.4.custom/jquery-ui.min.js') !!}
	{!! Html::script('assets/jquery-ui-1.11.4.custom/jquery-ui-touch-punch.min.js') !!}
	<script type="text/javascript">
  // Accordian
  function clicker()
  {
      window.location="/search/jobs"
      $('#slider').slider("value",0)
  }
        var action="click";
        var speed="500";
         //GLOBAL REQUIREMENTS
        var token = $('meta[name="csrf-token"]').attr('content'); 
        var animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        var pageloading = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><i class="fa fa-circle-o-notch fa-spin green"></i><i class="fa fa-circle-o-notch fa-spin red"></i><i class="fa fa-circle-o-notch fa-spin blue"></i></div></div>';
        var reloadbutton = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><button class="btn btn-lg btn-danger" onclick="window.location=window.location;">Reload Page</button></div></div>';

        function ajaxerror (){
            new PNotify({
                title: 'Error',
                text: 'We were unable to retrieve data from our servers. Refresh the page to try again.',
                type : 'error',
            });
        }

        function ajaxerrorclicktoclose (){
            var notice = new PNotify({
                title: 'Error',
                text: 'We were unable to retrieve data from our servers. Click here to try again.',
                type : 'error',
                buttons: {
                    closer: false,
                    sticker: false
                }
            });

            notice.get().click(function() {
                notice.remove();
                window.location = window.location;
            });
        }

        function addto(nid,element){
          var listVal = $(element).val();
          if(listVal === ''){
            listVal = nid;
            $(element).val(listVal);
          }else{
            var listArr = listVal.split(";;;;");
            if($.inArray(nid,listArr) === -1){
              listArr.push(nid);
              listVal = listArr.join(";;;;");
              $(element).val(listVal);
            }
          }

        }

        function removefrom(nid,element){
          var listVal = $(element).val();
          if(listVal !== ''){
            var listArr = listVal.split(";;;;");
            if($.inArray(nid,listArr) !== -1){
              var index = $.inArray(nid,listArr);
              listArr.splice(index,1);
              listVal = listArr.join(";;;;");
              $(element).val(listVal);
            }
          }
        }

        function redrawfilterbutton(){
          var locations = $('.user-list:checked').map(function (){
            return this.id;
          }).get().length;

          var industries = $('.industry-list:checked').map(function (){
            return this.id;
          }).get().length;

          var companies = $('.company-list:checked').map(function (){
            return this.id;
          }).get().length;

          var walkins = $('.walkin-check:checked').map(function (){
            return this.id;
          }).get().length;

          var salaryhighest = $('#salary_end').val();
          var salarylowest = $('#salary_start').val();
          var salarylow = $('#salary_range_start').val();
          var salaryhigh = $('#salary_range_end').val();

          if(locations >= 0 || industries >= 0 || companies >= 0 || salaryhigh !== '' || salarylow !== '' ||salarylowest !== '' || salaryhighest !== '' || walkins >= 0){
            if($('#activatefilternow').html() === ''){
              $('#activatefilternow').html('<button id="activatefilternowbutton" title="Apply filters" class="btn btn-sm">Apply Filters</button>');


                $('#activatefilternowbutton').click(function (e){
                $('form#search_jobs_form').submit();
              });
            }

          }else{
            $('#activatefilternow').html('');
          }

        }



        function reintializefilters (){
          var locations = $('#location_list').val();
          var industries = $('#industry_list').val();
          var companies = $('#company_list').val();
          var salarylow = $('#salary_range_start').val();
          var salaryhigh = $('#salary_range_end').val();
          var salarylowest = $('#salary_start').val();
          var salaryhighest = $('#salary_end').val();
          var walkin = $('#walkin').val();

          var locationArr = locations.split(';;;;');
          var industryArr = industries.split(';;;;');
          var companyArr = companies.split(';;;;');

          $.each(locationArr, function (i,val){

            $('[id="'+val+'_location"]').prop('checked',true);
          });

          $.each(industryArr, function (i,val){

            $('[id="'+val+'_industry"]').prop('checked',true);
          });

          $.each(companyArr, function (i,val){

            $('[id="'+val+'_company"]').prop('checked',true);
          });

          if (walkin != '') {
            $('[id="walkin-check"]').prop('checked',true);
          }

          if(salaryhigh !== '' && salarylow != '' && salaryhighest != ''){
            if(isNaN(parseInt(salaryhigh,10)) || isNaN(parseInt(salarylow,10))){
              new PNotify({
                  title: 'Error',
                  text: 'Salary range can only be calculated with numbers. Unfortunately there seems to be something else in the mix. Please refresh to try loading filters again.',
                  type : 'error',
              });
            }else{
              var high = parseInt(salaryhighest,10);
              var low = parseInt(salarylowest,10);
              var setvalue1 = parseInt(salarylow,10);
              var setvalue2 = parseInt(salaryhigh,10);
              $('#salary_range_display').html("<strong>Ranges between</strong> <span class='label label-primary'>"+setvalue1+"</span> <i class='fa fa-caret-left'></i>&nbsp;<i class='fa fa-caret-right'></i> <span class='label label-primary'>"+setvalue2+"</span>");
              $( ".filterrange" ).slider({
                 range:true,
                 min: low,
                 max: high,
                 step: 500,
                 values: [setvalue1,setvalue2],
                 slide: function( event, ui ) {
                     $( "#salary_range_start" ).val( ui.values[0] );
                     $( "#salary_range_end" ).val( ui.values[1] );
                    $( "#salary_start" ).val( low );
                    $( "#salary_end" ).val( high );
                    $( "#salary_range_display" ).html("<strong>Ranges between</strong> <span class='label label-primary'>"+ui.values[0]+"</span> <i class='fa fa-caret-left'></i>&nbsp;<i class='fa fa-caret-right'></i> <span class='label label-primary'>"+ui.values[1]+"</span>");
                    redrawfilterbutton();
                 },
                  change: function( event, ui ) {
                      $( "#salary_range_start" ).val( ui.values[0] );
                      $( "#salary_range_end" ).val( ui.values[1] );
                      $( "#salary_start" ).val( low );
                      $( "#salary_end" ).val( high );
                      $( "#salary_range_display" ).html("<strong>Ranges between</strong> <span class='label label-primary'>"+ui.values[0]+"</span> <i class='fa fa-caret-left'></i>&nbsp;<i class='fa fa-caret-right primary'></i> <span class='label label-primary'>"+ui.values[1]+"</span>");
                      redrawfilterbutton();
                  }
             });

            }
          }

        }


  $('#slider').slider("value",0)

  $('#sortbyselection').on('change',function() {
          var form = $('form#search_jobs_form');
          var order = $(this).val();
          var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "order").val(order);
          form.append(input);
          form.submit();
        });

    $(document).ready(function(){

        // Question handler               
        $('.filter-block li').on(action ,function(){
            // Get next element
            $(this).next()
                .slideToggle(speed)
                    // Select all other answers
                    .siblings('.filter-div')
                        .slideUp();
            $('.filter-block	 li.active').removeClass('active');
            $(this).addClass('active');
        });

        $('.c-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 6,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
      });

        
        $.post($('#searchjobsdata').val(),{_token:token},function (data){
          if(data === -1){
            ajaxerrorclicktoclose();
          }else{
            $('#user-box').html(data.locations);

            $('.user-list').change(function (event){
              if($(this).is(":checked")){
                addto($(this).attr('data-id'),'#location_list');
              }else{
                removefrom($(this).attr('data-id'),'#location_list');
              }
              redrawfilterbutton();
            });

            $('#industry-box').html(data.industry);

            $('.industry-list').change(function (event){
              if($(this).is(":checked")){
                addto($(this).attr('data-id'),'#industry_list');
              }else{
                removefrom($(this).attr('data-id'),'#industry_list');
              }
              redrawfilterbutton();
            });

            $('#company-box').html(data.companies);
            
            $('.company-list').change(function (event){
              if($(this).is(":checked")){
                addto($(this).attr('data-id'),'#company_list');
              }else{
                removefrom($(this).attr('data-id'),'#company_list');
              }
              redrawfilterbutton();
            });


            $('#walkin-check').change(function (event){
              if($(this).is(":checked")){
                addto($(this).attr('data-id'),'#walkin');
              }else{
                removefrom($(this).attr('data-id'),'#walkin');
              }
              redrawfilterbutton();
            });



          if(data.rangehighest && data.rangelowest){
            if(isNaN(parseInt(data.rangehighest,10)) || isNaN(parseInt(data.rangelowest,10))){
              new PNotify({
                  title: 'Error',
                  text: 'Salary range can only be calculated with numbers. Unfortunately there seems to be something else in the mix. Please refresh to try loading filters again.',
                  type : 'error',
              });
            }else{
              var high = parseInt(data.rangehighest,10);
              var low = parseInt(data.rangelowest,10);
              var mid = parseInt(parseInt(high)-parseInt(parseInt(high)/parseInt(2)),10);
              $('#salary_range_display').html("<strong>Ranges between</strong> <span class='label label-primary'>"+low+"</span> <i class='fa fa-caret-left'></i>&nbsp;<i class='fa fa-caret-right'></i> <span class='label label-primary'>"+high+"</span>");
              $( ".filterrange" ).slider({
                 range:true,
                 min: low,
                 max: high,
                 step: 500,
                 values: [low,high],
                 slide: function( event, ui ) {
                    $( "#salary_range_start" ).val( ui.values[0] );
                    $( "#salary_range_end" ).val( ui.values[1] );
                    $( "#salary_start" ).val( low );
                    $( "#salary_end" ).val( high );
                    $( "#salary_range_display" ).html("<strong>Ranges between</strong> <span class='label label-primary'>"+ui.values[0]+"</span> <i class='fa fa-caret-left'></i>&nbsp;<i class='fa fa-caret-right'></i> <span class='label label-primary'>"+ui.values[1]+"</span>");
                    redrawfilterbutton();
                 },
                 change: function( event, ui ) {
                    $( "#salary_range_start" ).val( ui.values[0] );
                    $( "#salary_range_end" ).val( ui.values[1] );
                    $( "#salary_start" ).val( low );
                    $( "#salary_end" ).val( high );
                    $( "#salary_range_display" ).html("<strong>Ranges between</strong> <span class='label label-primary'>"+ui.values[0]+"</span> <i class='fa fa-caret-left'></i>&nbsp;<i class='fa fa-caret-right primary'></i> <span class='label label-primary'>"+ui.values[1]+"</span>");
                    redrawfilterbutton();
                 }
             });

            }
          }
          
            reintializefilters();
          }
        });


      $('.joblisting').click(function(event){
        var jobid = $(this).prop('id');
        $('#jobdescription_'+jobid).hide(500);   
        $('#jobdetails_'+jobid).show(500);
      });

      $('.jobhiding').click(function(event){
        var jobid = $(this).attr('data-hide');
        $('#jobdescription_'+jobid).show(500);   
        $('#jobdetails_'+jobid).hide(500);
      });

    }); 

        
	</script>
@stop
