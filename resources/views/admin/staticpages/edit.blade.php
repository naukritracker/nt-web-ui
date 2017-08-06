@extends('templates.admin.master')

@section('content-header')
	Edit Static Page - {{$data['staticpage']->title}}
@stop

@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('StaticPages')}}"><i class="fa fa-file-o"></i> Static Pages</a></li>
	<li class="active"><i class="fa fa-gear"></i> Edit</li>
@stop

@section('content')
{!!Form::open(['route'=>array('SaveStaticPage',$data['staticpage']->id),'id'=>'edit_static_page_form'])!!}

<fieldset> 

	<div class="clearfix">

		<div class="col-sm-12"> 
			<div class="form-group"> 
		        {!!Form::text('title',$data['staticpage']->title,['placeholder'=>'Enter page title', 'class'=>'form-control', 'id'=>'title', ''])!!}
		    </div>
		</div>

		<div class="col-sm-12"> 
			<div class="form-group"> 
				{!!Form::text('keywords',$data['staticpage']->keywords,['placeholder'=>'Enter some keywords', 'class'=>'form-control', 'id'=>'keywords', ''])!!}
			</div>
		</div>

		<div class="col-sm-12"> 
			<div class="form-group"> 
				<textarea class="form-control" name="description" placeholder="Provide a description"  rows="1">{{$data['staticpage']->description}}</textarea> 
			</div>
		</div>

		<div class="col-sm-12"> 
			<div class="form-group"> 
				<textarea class="form-control" name="content" placeholder="Provide some content" >{{$data['staticpage']->content}}</textarea> 
			</div>
		</div>

	</div>

	<div class="col-xs-12 text-center">
		<button type="submit" class="btn btn-lg btn-success">Edit Page</button>
	</div>


</fieldset>

{!!Form::token()!!}
{!!Form::close()!!}

{!!Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js')!!}
<script type="text/javascript">
    CKEDITOR.replace( 'content' );
</script>
@stop