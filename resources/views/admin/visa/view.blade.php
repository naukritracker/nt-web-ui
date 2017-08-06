@extends('templates.admin.master')

@section('content-header')
	Visa - Listing
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-flag"></i> Visa</li>
@stop
@section('content')
	@if(count($data['countries'])>0)
		{!!$data['countries']->render()!!}
		<table class="table table-condensed">
			<thead>
				<th class="text-center" style="vertical-align: middle;float: none;">#</th>
				<th class="text-center" style="vertical-align: middle;float: none;">Country</th>
				<th>Visa</th>
			</thead>
			<tbody>
			@foreach($data['countries'] as $country)
				<tr>
					<td class="text-center" style="vertical-align: middle;float: none;">{{$country->id}}</td>
					<td class="text-center" style="vertical-align: middle;float: none;">{{$country->country}}</td>
					@if(count($country->visas)>0)
					<td><table class="table table-condensed">
						<thead>
							<th>Visa Type</th>
							<th class="text-center">More</th>
							<th class="text-center"><button class="btn btn-sm btn-danger bulkdelete" id="{{$country->id}}"><i class="fa fa-trash"></i></button></th>
						</thead>
						<tbody>
							@foreach($country->visas as $visa)
							<tr>
								<td>{{$visa->visa}}</td>
								<td class="text-center">
									<div class="col-xs-6 text-center"><a href="javascript:void(0)" class="editvisa" id="{{$visa->id}}"><i class="fa fa-gear" title="Edit {{$visa->visa}}"></i></a></div>
									<div class="col-xs-6 text-center"><a href="{{URL::route('DeleteVisa',[$visa->id])}}"><i class="fa fa-trash" style="color:red" title="Delete {{$visa->visa}}"></i></a></div>
								</td>
								<td class="text-center">
									<input type="checkbox" class="bulkaction_{{$country->id}}" id="{{$visa->id}}">
								</td>
							</tr>
							@endforeach
						</tbody>
					</table></td>
					@else
					<td><span class="label label-danger">No Visas Defined</span></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
		{!!$data['countries']->render()!!}
	@else
		<p class="text-danger">No <b>Jobs</b> have been posted. Add one <b><u><a href="{{URL::route('AddJobPosting')}}">now</a></u></b></p>
	@endif
@stop