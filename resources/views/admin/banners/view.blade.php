@extends('templates.admin.master')

@section('content-header')
	Banners - Listing
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-image"></i> Banners</li>
@stop
@section('content')
	<div class="col-xs-12">
		{!!Form::open(['route'=>array('SaveBanner'),'id'=>'form-banner','enctype'=>'multipart/form-data'])!!}
			<select name="type" class="form-control pull-right" style="width:15%;">
				<option value="company">Company</option>
				<option value="employer">Employer</option>
			</select>
			<input type="file" name="banner" id="banner" style="display: none">
		{!!Form::close()!!}
        <br /><br />
        <a href="#" class="btn btn-lg btn-success pull-right addbanner" id="addbanner">Add Banner</a>
	</div>

	@if(count($data['banners']) > 0)
		<table class="table table-condensed">
			<thead>
				<th class="text-center" style="vertical-align: middle;float: none;">#</th>
				<th class="text-center" style="vertical-align: middle;float: none;">Banner</th>
				<th class="text-center" style="vertical-align: middle;float: none;">Type</th>
				<th class="text-center">Options</th>
			</thead>
			<tbody>
				@foreach($data['banners'] as $banner)
					<tr>
						<td class="text-center">{{$banner->id}}</td>
						<td class="text-center">{!!Html::image('/uploads/banners/'.$banner->banner,'',['height' => '100px', 'width' => '100px'])!!}</td>
						<td class="text-center">{{$banner->type}}</td>
						<td class="text-center">
							<div class="col-xs-6">
								@if ($banner->active_flag == 0)
									<a href="{{URL::route('ActivateBanner',$banner->id)}}"><i class="fa fa-times-circle-o" style="color:purple" title="Click to Activate"></i></a>
								@else
									<a href="{{URL::route('DeactivateBanner',$banner->id)}}"><i class="fa fa-check-circle-o" style="color:green" title="Click to Deactivate"></i></a>
								@endif
							</div>
							<div class="col-xs-6">
								<a href="{{URL::route('DeleteBanner',$banner->id)}}"><i class="fa fa-trash" style="color:red" title="Delete"></i></a>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<p class="text-danger">No <b>Banners</b> have been posted. Add one <b><u><a href="javascript:void(0)" class="addbanner">now</a></u></b></p>
		@endif
@stop

@section('js')
	@parent
	<script type="text/javascript">

		$('.addbanner').click(function (e){
			$('#banner').trigger('click');
		});

	    $('#banner').change(function (e){
	    	$('#form-banner').submit();
	    });

	    $('#form-banner').submit(function (e) {
	    	e.preventDefault();
	    	$('#addbanner').html('<i class="fa fa-spin fa-circle-o"></i>');
	    	$.ajax({
		      url: 'banners/save',
		      type: 'POST',
		      data: new FormData( this ),
		      processData: false,
		      contentType: false,
		      success: function (data) {
		      	if (data.success) {
			      	$.each(data.success, function(i,val){
	                	new PNotify({
	                        icon: 'fa fa-thumbs-o-up',
	                        text: val,
	                        type : 'success',
	                    });
	                });

	                setTimeout(function() 
						{
							$('#addbanner').html('Add Banner');
							window.location = data.redirect;
						}
					, 3000);
	            } else {
	            	$.each(data.errors, function(i,val){
	            		$('#addbanner').html('Add Banner');
	                	new PNotify({
	                        icon: 'Error',
	                        text: val,
	                        type : 'error',
	                    });
	                });
	            }
		      },
		      error: function (error) {
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
		      }		      
		    });
	    });
	</script>
@stop