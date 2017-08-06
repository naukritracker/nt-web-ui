@extends('templates.admin.master')

@section('content-header')
	Static Pages - Listing
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-file-o"></i> Static Pages</li>
@stop

@section('content')
	<div class="col-xs-12 pad-b20">
		<div class="col-xs-6">
			@if(count($data['staticpages'])>0)
			<div class="btn-group">
				<button type = "button" class="btn btn-sm btn-success" id="bulkactivate" title="Activate Selected"><i class="fa fa-check-circle-o"></i></button>
				<button type = "button" class="btn btn-sm" style="background-color:purple;color:white" id="bulkdeactivate" title="Deactivate Selected"><i class="fa fa-times-circle-o"></i></button>
				<button type = "button" class = "btn btn-sm btn-danger" id="bulkdelete" title="Delete Selected"><i class="fa fa-trash"></i></button>
			</div>	
			@endif
		</div>
		<div class="col-xs-6">
			<div class="col-xs-2 pull-right">
				<a href="{{URL::route('NewStaticPage')}}" id="addpage" class="btn btn-success addpage">New Page</a>
			</div>
		</div>
	</div>

	@if(count($data['staticpages'])>0)
		{!!$data['staticpages']->render()!!}
		<table class="table table-condensed">
			<thead>
				<th><a href="javascript:void(0)" id="bulkactionall" status="0"><i class="fa fa-square-o"></i></a></th>
				<th>#</th>
				<th>UUID</th>
				<th>Title</th>
				<th>Description</th>
				<th class="text-center">More</th>
			</thead>
			<tbody>
			<?php $i=1;?>
			@foreach($data['staticpages'] as $page)
				<tr>
					<td><input type="checkbox" class="bulkaction" id="{{$page->id}}"></td>
					<td>{{$i}}</td>
					<td>{{$page->id}}</td>
					<td>{{$page->title}}</td>
					<td>{{$page->description}}</td>
					<td class="text-center">
						<div class="col-xs-3 text-center"><a href="javascript:void(0)" class="viewpage" id="{{$page->id}}"><i class="fa fa-eye" title="View {{$page->title}} details"></i></a></div>
						@if($page->active_flag == 1)
						<div class="col-xs-3 text-center"><a href="{{URL::route('UpdateStaticPageStatus',[$page->id])}}" id="{{$page->id}}"><i class="fa fa-check-circle-o" style="color:green" title="Active"></i></a></div>
						@elseif($page->active_flag == 0)
						<div class="col-xs-3 text-center"><a href="{{URL::route('UpdateStaticPageStatus',[$page->id])}}" id="{{$page->id}}"><i class="fa fa-times-circle-o" style="color:purple" title="Not Active"></i></a></div>
						@endif
						<div class="col-xs-3 text-center"><a href="{{URL::route('EditStaticPage',[$page->id])}}" class="editpage" id="{{$page->id}}"><i class="fa fa-gear" title="Edit {{$page->title}}"></i></a></div>
						<div class="col-xs-3 text-center"><a href="{{URL::route('DeleteStaticPage',[$page->id])}}"><i class="fa fa-trash" style="color:red" title="Delete {{$page->title}}"></i></a></div>
					</td>
				</tr>
				<?php $i++;?>
			@endforeach
			</tbody>
		</table>
		{!!$data['staticpages']->render()!!}
	@else
		<p class="text-danger">No <b>Static Pages</b> have been added. Add one <b><u><a href="{{URL::route('NewStaticPage')}}" class="addstaticpage">now</a></u></b></p>
	@endif

	<!-- Modal -->
	<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="pageModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body" id="pageModalBody">
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
			var pages = $('.bulkaction');
			var selectedpages = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(pages,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedpages.push($(val).prop('id'));
					}
				}
			});
			if(selectedpages.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To activate pages, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/static/pages/async/bulk/activate/'+selectedpages.join('||');
			}
			
		});

		$('#bulkdeactivate').click(function (e){
			var pages = $('.bulkaction');
			var selectedpages = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(pages,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedpages.push($(val).prop('id'));
					}
				}
			});
			if(selectedpages.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To deactivate pages, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/static/pages/async/bulk/deactivate/'+selectedpages.join('||');
			}
			
		});

		$('#bulkdelete').click(function (e){
			var pages = $('.bulkaction');
			var selectedpages = [];
			var loc = window.location.protocol+'//'+window.location.host;
			$.each(pages,function (i,val){
				var check = $(val).prop('checked');
				if(check){
					if($(val).prop('id')){
						selectedpages.push($(val).prop('id'));
					}
				}
			});
			if(selectedpages.length === 0){
				new PNotify({
                    title: 'Error',
                    text: 'To delete pages, select at least one.',
                    type : 'error',
                });
			}else{
				window.location = loc+'/admin/static/pages/async/bulk/delete/'+selectedpages.join('||');
			}
			
		});



		$('.viewpage').click(function (){
			$('#loadingModal').modal('show'); 
			$.post('pages/async/view/'+$(this).attr('id'),{_token:token},function (data){
				$('#pageModalLabel').html(data['title']);
				$('#pageModalBody').html(data['body']);
				$('#loadingModal').modal('hide'); 
				$('#pageModal').modal('show');
			}).fail(function(){
				$('#loadingModalBody').html('<span class="text-danger">Unable to retrieve data</span>');
				setTimeout(function(){ $('#loadingModal').modal('hide');$('#loadingModalBody').html(pageloadingleft); }, 4000);
			});

		});

		
	</script>
@stop