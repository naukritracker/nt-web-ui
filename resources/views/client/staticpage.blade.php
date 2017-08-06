@extends('templates.client.master')

@section('title')
@parent
 - {{$data['page']->title}}
@stop

@section('meta')
  @parent
  <meta name="keywords" content="{{$data['page']->keywords}}">
  <meta name="description" content="{{$data['page']->description}}">
  <meta name="robots" content="index/nofollow">
@stop

@section('content')
<div class="container pad-t85 mar-t20">
    <div class="row mar-b20">
        <div class="col-sm-9">
            {!!$data['page']->content!!}
        </div>


        @include('client.partials.latestjobsinner') 
    </div>
</div>
@stop
