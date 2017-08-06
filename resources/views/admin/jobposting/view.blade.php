@extends('templates.admin.master')

@section('content-header')
	Jobs - Listing
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-industry"></i> Jobs</li>
@stop

@section('content')
	<div class="col-xs-12 pad-b20">
		<div class="col-xs-6">
		@if(count($data['jobs'])>0)
			<div class="btn-group">
				<button type = "button" class="btn btn-sm btn-success" id="bulkactivate" title="Activate Selected"><i class="fa fa-check-circle-o"></i></button>
				<button type = "button" class="btn btn-sm btn-warning" id="bulkreview" title="Review Selected"><i class="fa fa-circle"></i></button>
				<button type = "button" class="btn btn-sm" style="background-color:purple;color:white" id="bulkdeactivate" title="Deactivate Selected"><i class="fa fa-times-circle-o"></i></button>
				<button type = "button" class = "btn btn-sm btn-danger" id="bulkdelete" title="Delete Selected"><i class="fa fa-trash"></i></button>
			</div>	
		@endif
		</div>
		<div class="col-xs-6">
			<div class="col-xs-2 pull-right">
				<a href="javascript:void(0)" id="addjob" class="btn btn-success addjob">New Job</a>
			</div>
			<div class="col-xs-10">
				@if(Auth::user()->hasRole(['admin','su']))
					{!!Form::open(['route'=>'JobPosting','id'=>'form-select-user'])!!}
						<select name="user" id="user" class="form-control">
							<option value="" @if(!isset($data['selecteduser'])) selected @endif>All</option>
							@foreach($data['users'] as $moderator)
								@if($moderator->hasRole(['moderator']) AND $moderator->id != Auth::user()->id)
								<option value="{{$moderator->id}}" @if($moderator->id == $data['selecteduser']) selected @endif>{{$moderator->name}}</option>
								@endif
							@endforeach
						</select>
					{!!Form::close()!!}
				@endif
			</div>
		</div>
		
	</div>

	@if(count($data['jobs'])>0)
		{!!$data['jobs']->appends(['user' => isset($data['selecteduser']) ? $data['selecteduser'] : ''])->render()!!}
		<table class="table table-condensed">
			<thead>
				<th><a href="javascript:void(0)" id="bulkactionall" status="0"><i class="fa fa-square-o"></i></a></th>
				<th>#</th>
				<th>UUID</th>
				<th>
					@if(isset($sort) AND $sort == 'title') 
						@if(isset($order) AND $order == 'desc')
						<a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=asc">Title <i class="fa fa-caret-down"></i></a>
						@elseif(isset($order) AND $order == 'asc')
						<a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=desc">Title <i class="fa fa-caret-up"></i></a>
						@endif
					@else
						<a href="{{URL::route('JobPosting')}}?sort=title&order=desc">Title</a>
					@endif
				</th>
				<th>
				 	@if(isset($sort) AND $sort == 'state_id') 
                                                @if(isset($order) AND $order == 'desc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=asc">Location <i class="fa fa-caret-down"></i></a>
                                                @elseif(isset($order) AND $order == 'asc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=desc">Location <i class="fa fa-caret-up"></i></a>
                                                @endif
                                        @else
                                                <a href="{{URL::route('JobPosting')}}?sort=state_id&order=desc">Location</a>
                                        @endif	
				</th>
				<th>
				 	@if(isset($sort) AND $sort == 'apply') 
                                                @if(isset($order) AND $order == 'desc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=asc">Job Type<i class="fa fa-caret-down"></i></a>
                                                @elseif(isset($order) AND $order == 'asc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=desc">Job Type<i class="fa fa-caret-up"></i></a>
                                                @endif
                                        @else
                                                <a href="{{URL::route('JobPosting')}}?sort=apply&order=desc">Job Type</a>
                                        @endif	
				</th>
                                <th>
				 	@if(isset($sort) AND $sort == 'active_flag') 
                                                @if(isset($order) AND $order == 'desc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=asc">Job Status<i class="fa fa-caret-down"></i></a>
                                                @elseif(isset($order) AND $order == 'asc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=desc">Job Status<i class="fa fa-caret-up"></i></a>
                                                @endif
                                        @else
                                                <a href="{{URL::route('JobPosting')}}?sort=active_flag&order=desc">Job Status</a>
                                        @endif	
				</th>
				<th>
					@if(isset($sort) AND $sort == 'created_at') 
                                                @if(isset($order) AND $order == 'desc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=asc">Created <i class="fa fa-caret-down"></i></a>
                                                @elseif(isset($order) AND $order == 'asc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=desc">Created <i class="fa fa-caret-up"></i></a>
                                                @endif
                                        @else
                                                <a href="{{URL::route('JobPosting')}}?sort=created_at&order=desc">Created</a>
                                        @endif	
				</th>
				<th>
					@if(isset($sort) AND $sort == 'updated_at') 
                                                @if(isset($order) AND $order == 'desc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=asc">Last Modified <i class="fa fa-caret-down"></i></a>
                                                @elseif(isset($order) AND $order == 'asc')
                                                <a href="{{URL::route('JobPosting')}}?sort={{$sort}}&order=desc">Last Modified <i class="fa fa-caret-up"></i></a>
                                                @endif
                                        @else
                                                <a href="{{URL::route('JobPosting')}}?sort=updated_at&order=desc">Last Modified</a>
                                        @endif	
				</th>
				<th class="text-center">More</th>
			</thead>
			<tbody>
			<?php $i=1;?>
			@foreach($data['jobs'] as $job)
				<tr>
					<td><input type="checkbox" class="bulkaction" id="{{$job->id}}"></td>
					<td>{{$i}}</td>
					<td>{{$job->id}}</td>
					<td>{{$job->title}}</td>
					<td>
						@if($job->state)
							{{$job->state->state}} ({{$job->country->country}})
						@else
							Not Provided
						@endif
					</td>
					<td>
					@if($job->apply != '' AND $job->walkin == 0) 
						<a href="{{$job->apply}}" target="_blank">Apply Online</a>
					@elseif($job->apply == '' AND $job->walkin == 1)
						<span style="color:green">Walk In</span>
					@else
						<span style="color:red">Not Specified</span>
					@endif
					</td>
					<td>
					@if($job->active_flag == 0)
						<span style="color:red;">Inactive</span>
					@elseif($job->active_flag == 2)
						<span style="color:orange;">Under Review</span>
					@elseif($job->active_flag == 1)
						<span style="color:green;">Active</span>
					@else
						<span style="color:red;">Not Specified</span>
					@endif
					</td>
					<td>
					@if(Auth::user()->hasRole(['admin','su']))
                        @if($job->posted_by_employer)
                            {{$job->employer->name}}
                        @else
                            {{$job->user->name}}
                        @endif
                        <b>[
                    @endif

					{{ $job->created_at->diffForHumans() }}
					@if(Auth::user()->hasRole(['admin','su'])) ]</b> @endif
					</td>
					<td>
					@if(Auth::user()->hasRole(['admin','su']))
                        @if($job->posted_by_employer)
                            {{$job->modifiedemployer->name}}
                        @else
                            {{$job->modifieduser->name}}
                        @endif
                        <b>[
                    @endif
					{{ $job->updated_at->diffForHumans() }}
					@if(Auth::user()->hasRole(['admin','su'])) ]</b> @endif
					</td>
					<td class="text-center">
						<div class="col-xs-3 text-center"><a href="javascript:void(0)" class="viewjob" id="{{$job->id}}"><i class="fa fa-eye" title="View {{$job->title}} details"></i></a></div>
						@if($job->active_flag == 1)
						<div class="col-xs-3 text-center"><a href="{{URL::route('UpdateJobStatus',[$job->id])}}" id="{{$job->id}}"><i class="fa fa-check-circle-o" style="color:green" title="Active"></i></a></div>
						@elseif($job->active_flag == 2)
						<div class="col-xs-3 text-center"><a href="{{URL::route('UpdateJobStatus',[$job->id])}}" id="{{$job->id}}"><i class="fa fa-circle" style="color:orange" title="Under Review"></i></a></div>
						@elseif($job->active_flag == 0)
						<div class="col-xs-3 text-center"><a href="{{URL::route('UpdateJobStatus',[$job->id])}}" id="{{$job->id}}"><i class="fa fa-times-circle-o" style="color:purple" title="Not Active"></i></a></div>
						@endif
						<div class="col-xs-3 text-center"><a href="javascript:void(0)" class="editjob" id="{{$job->id}}"><i class="fa fa-gear" title="Edit {{$job->title}}"></i></a></div>
						@if(Auth::user()->hasRole(['su','admin'])) <div class="col-xs-3 text-center"><a href="{{URL::route('DeleteJobPosting',[$job->id])}}"><i class="fa fa-trash" style="color:red" title="Delete {{$job->title}}"></i></a></div> @endif
					</td>
				</tr>
				<?php $i++;?>
			@endforeach
			</tbody>
		</table>
		{!!$data['jobs']->appends(['user' => isset($data['selecteduser']) ? $data['selecteduser'] : '', 'sort' => isset($sort) ? $sort : '','order' =>isset($order) ? $order : ''])->render()!!}
	@else
		<p class="text-danger">No <b>Jobs</b> have been posted. Add one <b><u><a href="javascript:void(0)" class="addjob">now</a></u></b></p>
	@endif

	<!-- Modal -->
	<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="jobModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body" id="jobModalBody">
	        ...
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
	        <h4 class="modal-title" id="loadingModalLabel">Loading...</h4>
	      </div>
	      <div class="modal-body" id="loadingModalBody">
	        <div class="clearfix pad-l50pr">
	        <i class="fa fa-circle-o-notch fa-spin green"></i>
	        <i class="fa fa-circle-o-notch fa-spin red"></i>
	        <i class="fa fa-circle-o-notch fa-spin blue"></i>
	    </div>
	      </div>
	      <div class="modal-footer">
	        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>

<!-- Company Popup -->
<div class="modal fade" id="new-company-popup" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enter employer details</h4>
      </div>
      <!--OPEN FORM HERE-->
      <div class="modal-body">
        {!!Form::open(array('route'=>'RegisterCompany','id'=>'new_company_form','class'=>'row pad-t10 pad-b10'))!!}
        <div class="col-sm-6 hidden-xs">
            
            <div class="form-group">
              <label for="name">Employer <span class="error-text">*</span></label>                            
              {!!Form::text('name',null,['placeholder'=>'Specify Employer','class'=>'form-control','id'=>'register_company_name','required'])!!}
            </div>
            <div class="form-group">
              <label for="description">Description</label>                            
              <textarea name="description" rows="2" class="form-control" placeholder="A short description"></textarea>
            </div>
            <div class="form-group">
              <label for="city">City of operations</label>                            
              {!!Form::text('city',null,['placeholder'=>'City','class'=>'form-control','id'=>'register_city'])!!}
            </div>
            <div class="form-group"> 
              <label for="country">Select country of operations <span class="error-text">*</span></label>                           
              {!!Form::select('country',$data['countries'],null,['placeholder'=>'Select country','class'=>'form-control','id'=>'register_country','required'])!!}
            </div>
            <div class="form-group">
              <label for="state">Select region of opertaions <span class="error-text">*</span></label>           
              {!!Form::select('state',[],null,['placeholder'=>'Select state','class'=>'form-control','id'=>'register_state','required'])!!}
            </div>
        </div>
         <div class="col-sm-6">
          <div class="form-group">
            <label for="contactNo">Contant number</label>                            
            {!!Form::number('contactNo',null,['placeholder'=>'Country code - Contact number','class'=>'form-control','id'=>'register_contactNo'])!!}
          </div>
          <div class="form-group">
            <label for="website">Employer Website</label>                            
            {!!Form::text('website',null,['placeholder'=>'Employee website','class'=>'form-control','id'=>'register_website'])!!}
          </div>   
          <div class="form-group">                              
            <!-- COMPANY ADDRESS -->
            <label for="address">Employer Address</label>
            <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
          </div>
          <div class="clearfix text-center">
              <!-- SUBMIT BUTTON -->
              <button type="submit" class="btn btn-lg btn-success">Add Your Company</button>
          </div>                    
         </div>
         {!!Form::token()!!}                                      
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div> 
@stop

@section('js')
	@parent
	{!!Html::script('assets/js/jquery.validate.min.js')!!}
	{!!Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js')!!}

	<script type="text/javascript">

		$('#bulkactionall').click(function (e){
			var status = $(this).attr('status');
			if(status == 0){
				$(this).attr('status',1);
				$(this).html('<i class="fa fa-minus-square"></i>');
				$('.bulkaction').prop('checked',true);
			}

			if(status == 1){
				$(this).attr('status',0);
				$(this).html('<i class="fa fa-square-o"></i>');
				$('.bulkaction').prop('checked',false);
			}
		});

		$('#bulkactivate').click(function (e){
			var jobs = $('.bulkaction');
			var selectedjobs = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(jobs,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedjobs.push($(val).prop('id'));
					}
				}
			});
			if(selectedjobs.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To activate jobs, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/jobposting/async/bulk/activate/'+selectedjobs.join('||');
			}
			
		});

		$('#bulkdeactivate').click(function (e){
			var jobs = $('.bulkaction');
			var selectedjobs = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(jobs,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedjobs.push($(val).prop('id'));
					}
				}
			});
			if(selectedjobs.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To deactivate jobs, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/jobposting/async/bulk/deactivate/'+selectedjobs.join('||');
			}
			
		});

		$('#bulkreview').click(function (e){
			var jobs = $('.bulkaction');
			var selectedjobs = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(jobs,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedjobs.push($(val).prop('id'));
					}
				}
			});
			if(selectedjobs.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To sent jobs for review, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/jobposting/async/bulk/review/'+selectedjobs.join('||');
			}
			
		});

		$('#bulkdelete').click(function (e){
			var jobs = $('.bulkaction');
			var selectedjobs = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(jobs,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedjobs.push($(val).prop('id'));
					}
				}
			});
			if(selectedjobs.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To delete jobs, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/jobposting/async/bulk/delete/'+selectedjobs.join('||');
			}
			
		});



		$('.viewjob').click(function (){
			$('#loadingModal').modal('show'); 
			$.post('jobposting/async/view/'+$(this).attr('id'),{_token:token},function (data){
				$('#jobModalLabel').html(data['title']);
				$('#jobModalBody').html(data['body']);
				$('#loadingModal').modal('hide'); 
				$('#jobModal').modal('show');
			}).fail(function(){
				$('#loadingModalBody').html('<span class="text-danger">Unable to retrieve data</span>');
				setTimeout(function(){ $('#loadingModal').modal('hide');$('#loadingModalBody').html(pageloadingleft); }, 4000);
			});

		});


		var isFirst = 1;
		$('.addjob').click(function (event){
			event.preventDefault();
			$('#loadingModal').modal({show: true,backdrop: 'static', keyboard: false}); 
			$.post('jobposting/add/async/loadform',{_token:token},function (data){
				$('#jobModalLabel').html('Add Job');
				$('#jobModalBody').html(data);

				$('#country_id').on('click change',function(){
					if($(this).val()){
						$.post('jobposting/add/async/loadcountryrelateddata/'+$(this).val(),{_token:token},function (data){
							$('#state_id').html(data.states);
							$('#visa_id').html(data.visas);
						}).fail(function(){
							var notice = new PNotify({
			                    title: 'Error',
			                    text: 'We were unable to retrieve form data from our servers.',
			                    type : 'error',
			                    buttons: {
			                        closer: false,
			                        sticker: false
			                    }
			                });

			                notice.get().click(function() {
			                    notice.remove();
			               });
						});
					}
				});

				$("#company").on('click change',function (e){
		              if(e.target.value === 'new'){
		                  e.target.value = '';
		                  $('#new-company-popup').modal({show: true,backdrop: 'static', keyboard: false});
		              }
		        });


			    CKEDITOR.replace( 'description' );
				CKEDITOR.instances['description'].on( 'focus', function( evt ) {
					if (isFirst) {
					  isFirst = 0;
					  CKEDITOR.instances['description'].setData( '' );
					}
				});

				
				$('#loadingModal').modal('hide'); 
				$('#jobModal').modal({show: true,backdrop: 'static', keyboard: false});
			}).fail(function(){
				$('#loadingModalBody').html('<span class="text-danger">Unable to retrieve data</span>');
				setTimeout(function(){ $('#loadingModal').modal('hide');$('#loadingModalBody').html(pageloadingleft); }, 4000);
			});

			$('.preview-button').click(function (e) {
				var href = $(this).attr('href');
				console.log(href);
				$(this).attr('href',href+$('#add_jobposting_form').serialize());
				return false;
			});
		});


		$('.editjob').click(function (){
			$('#loadingModal').modal({show: true,backdrop: 'static', keyboard: false}); 
			$.post('jobposting/async/edit/'+$(this).attr('id'),{_token:token},function (data){
				$('#jobModalLabel').html(data['title']);
				$('#jobModalBody').html(data['body']);

				$('#country_id').click(function(){
					if($(this).val()){
						$.post('jobposting/add/async/loadcountryrelateddata/'+$(this).val(),{_token:token},function (data){
							$('#state_id').html(data.states);
							$('#visa_id').html(data.visas);
						}).fail(function(){
							var notice = new PNotify({
			                    title: 'Error',
			                    text: 'We were unable to retrieve form data from our servers.',
			                    type : 'error',
			                    buttons: {
			                        closer: false,
			                        sticker: false
			                    }
			                });

			                notice.get().click(function() {
			                    notice.remove();
			                });
						});
					}
				});

				CKEDITOR.replace( 'description' );

				$('#loadingModal').modal('hide'); 
				$('#jobModal').modal({show: true,backdrop: 'static', keyboard: false});

			}).fail(function(){
				$('#loadingModalBody').html('<span class="text-danger">Unable to retrieve data</span>');
				setTimeout(function(){ $('#loadingModal').modal('hide');$('#loadingModalBody').html(pageloadingleft); }, 4000);
			});

			$('.preview-button').click(function () {
                                var href = $(this).attr('href');
				console.log(href);
                                $(this).attr('href',href+$('#edit_jobposting_form').serialize());
                        });


		});


        $('#new_company_form').validate({
              messages:{
                  name:{
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",
                  },
                  country: { 
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
                  },
                  state: { 
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
                  },
                  company: {
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
                  }
              },
              onkeyup: function(element) {$(element).valid()},
              errorPlacement: function(label, element) {
                  label.css('color','red');
                  label.insertBefore(element);
              },
		});

        $('#register_country').on('click change',function(event){
          if($(this).val() === ''){
            $('#register_state').html('<option value="" selected>Select state</option>');
          }else{
            $.post('register/async/loadstatelist/'+$(this).val(),{_token:token},function (data){
              $('#register_state').html(data);
	        }).fail(function (){
	          var notice = new PNotify({
	                title: 'Error',
	                text: 'We were unable to retrieve data from our servers. Click here to try again.',
	                type : 'error',
	                buttons: {
	                    closer: false,
	                    sticker: false,
	                }
	            });

	            notice.get().click(function() {
	                notice.remove();
	                window.location = window.location;
	            });
	        });
      	  }
    	});

    	$('#user').on('change', function (e) {
    		$('#form-select-user').submit();
    	});
	</script>
@stop
