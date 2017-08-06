@extends('templates.admin.master')

@section('content-header')
	Users - Listing
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-user"></i> Users</li>
@stop

@section('content')
	@if(count($data['users'])>0)
		{!!$data['users']->render()!!}
		<table class="table table-condensed">
			<thead>
				<th><a href="javascript:void(0)" id="bulkactionall" status="0"><i class="fa fa-square-o"></i></a></th>
				<th>#</th>
				<th>UUID</th>
				<th>User</th>
				<th>Username</th>
				<th>Role</th>
				<th class="text-center">More</th>
			</thead>
			<tbody>
			<?php $i=1;?>
			@foreach($data['users'] as $user)
			@if(!$user->hasRole(['su','admin']))
				<tr>
					<td><input type="checkbox" class="bulkaction" id="{{$user->id}}"></td>
					<td>{{$i}}</td>
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
						@foreach($user->roles as $role)
							@if($role == $user->roles[0])
								{{$role->display_name}}
							@else
								, {{$role->display_name}}
							@endif
						@endforeach
					</td>
					<td class="text-center">
						@if($user->hasRole(['candidate']))
							<a href="{{URL::route('SetUserRole',['moderator',$user->id])}}" id="{{$user->id}}"><i class="fa fa-user" style="color:green" title="Set as Moderator"></i> Set as Moderator</a>
						@elseif($user->hasRole(['moderator']))
							<a href="{{URL::route('SetUserRole',['candidate',$user->id])}}" id="{{$user->id}}"><i class="fa fa-user-secret" style="color:orange" title="Set as Candidate"></i> Set as Candidate</a>
						@elseif($user->hasRole(['admin','su']))
							<i class="fa fa-exclamation-circle" style="color:gray" title="Set as Candidate"></i> No change possible
						@endif
					</td>
				</tr>
				<?php $i++;?>
			@endif
			@endforeach
			</tbody>
		</table>
		{!!$data['users']->render()!!}
	@else
		<p class="text-danger">No <b>Jobs</b> have joined yet.</p>
	@endif

@stop

@section('js')
	@parent
	{!!Html::script('assets/js/jquery.validate.min.js')!!}
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

				
				$('#loadingModal').modal('hide'); 
				$('#jobModal').modal({show: true,backdrop: 'static', keyboard: false});
			}).fail(function(){
				$('#loadingModalBody').html('<span class="text-danger">Unable to retrieve data</span>');
				setTimeout(function(){ $('#loadingModal').modal('hide');$('#loadingModalBody').html(pageloadingleft); }, 4000);
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

				$('#loadingModal').modal('hide'); 
				$('#jobModal').modal({show: true,backdrop: 'static', keyboard: false});

			}).fail(function(){
				$('#loadingModalBody').html('<span class="text-danger">Unable to retrieve data</span>');
				setTimeout(function(){ $('#loadingModal').modal('hide');$('#loadingModalBody').html(pageloadingleft); }, 4000);
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
                  comapany: { 
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
	</script>
@stop
