@extends('templates.admin.master')

@section('content-header')
	Static Pages - Add Page
@stop

@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('StaticPages')}}"><i class="fa fa-file-o"></i> Static Pages</a></li>
	<li class="active"><i class="fa fa-plus"></i> Add</li>
@stop

@section('content')
{!!Form::open(['route'=>'SaveStaticPage','id'=>'add_static_page_form'])!!}

<fieldset> 

	<div class="clearfix">

		<div class="col-sm-12"> 
			<div class="form-group"> 
		        {!!Form::text('title',null,['placeholder'=>'Enter page title', 'class'=>'form-control', 'id'=>'title', ''])!!}
		    </div>
		</div>

		<div class="col-sm-12"> 
			<div class="form-group"> 
				{!!Form::text('keywords',null,['placeholder'=>'Enter some keywords', 'class'=>'form-control', 'id'=>'keywords', ''])!!}
			</div>
		</div>

		<div class="col-sm-12"> 
			<div class="form-group"> 
				<textarea class="form-control" name="description" placeholder="Provide a description"  rows="1"></textarea> 
			</div>
		</div>

		<div class="col-sm-12"> 
			<div class="form-group"> 
				<textarea class="form-control" name="content" placeholder="Provide some content" ></textarea> 
			</div>
		</div>

	</div>

	<div class="col-xs-12 text-center">
		<button type="submit" class="btn btn-lg btn-success">Add Page</button>
	</div>


</fieldset>

{!!Form::token()!!}
{!!Form::close()!!}

{!!Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js')!!}
<script type="text/javascript">
    CKEDITOR.replace( 'content' );
</script>
@stop