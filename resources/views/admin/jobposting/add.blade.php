@extends('templates.admin.master')

@section('content-header')
	Jobs - Add Listing
@stop

@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('JobPosting')}}"><i class="fa fa-industry"></i> Job Posting</a></li>
	<li class="active"><i class="fa fa-plus"></i> Add</li>
@stop

@section('content')
	<div id="add_job_box">
		<div class="clearfix pad-t40pr pad-l50pr">
	        <i class="fa fa-circle-o-notch fa-spin green"></i>
	        <i class="fa fa-circle-o-notch fa-spin red"></i>
	        <i class="fa fa-circle-o-notch fa-spin blue"></i>
	        <p><b>Loading...</b></p>
	    </div>
	</div>
@stop

@section('js')
	@parent
	<script type="text/javascript">
  
		$(document).ready(function (){
			$.post('add/async/loadform',{_token:token},function (data){
				var animationName = "animated flip"
				$('#add_job_box').addClass(animationName).html(data).one(animationend,function() {
	              $(this).removeClass(animationName);
	            });

	            $('#country_id').on('change click',function(){
					$.post('add/async/loadcountryrelateddata/'+$(this).val(),{_token:token},function (data){
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
				});

			}).fail(function (){
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
		});


	</script>
@stop