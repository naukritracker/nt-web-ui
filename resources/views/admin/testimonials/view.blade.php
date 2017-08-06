@extends('templates.admin.master')

@section('content-header')
    Testimonials - Listing
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-quote-left"></i> Testimonials</li>
@stop
@section('content')
    <div class="col-xs-12">
        <a href="#" class="btn btn-lg btn-success pull-right addtestimonial" id="addtestimonial">Add Testimonial</a>
    </div>

    @if(count($data['testimonials']) > 0)
        <table class="table table-condensed">
            <thead>
            <th class="text-center" style="vertical-align: middle;float: none;">#</th>
            <th class="text-center" style="vertical-align: middle;float: none;">Content</th>
            <th class="text-center" style="vertical-align: middle;float: none;">Author</th>
            <th class="text-center">Options</th>
            </thead>
            <tbody>
            @foreach($data['testimonials'] as $testimonial)
                <tr>
                    <td class="text-center">{{$testimonial->id}}</td>
                    <td class="text-center">{{$testimonial->content}}</td>
                    <td class="text-center">{{$testimonial->author}}</td>
                    <td class="text-center">
                        <div class="col-xs-6">
                            @if ($testimonial->active_flag == 0)
                                <a href="{{URL::route('ActivateTestimonial',$testimonial->id)}}"><i class="fa fa-times-circle-o" style="color:purple" title="Click to Activate"></i></a>
                            @else
                                <a href="{{URL::route('DeactivateTestimonial',$testimonial->id)}}"><i class="fa fa-check-circle-o" style="color:green" title="Click to Deactivate"></i></a>
                            @endif
                        </div>
                        <div class="col-xs-6">
                            <a href="{{URL::route('DeleteTestimonial',$testimonial->id)}}"><i class="fa fa-trash" style="color:red" title="Delete"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-danger">No <b>Testimonials</b> have been posted. Add one <b><u><a href="javascript:void(0)" class="addtestimonial">now</a></u></b></p>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="testimonialModalLabel">Add Testimonial</h4>
                </div>
                <div class="modal-body" id="testimonialModalBody">
                    <form id="form-testimonial" name="form-testimonial" action="{{URL::route('SaveTestimonial')}}" method="post">
                        <textarea name="content" class="form-control" placeholder="Testimonial"></textarea>
                        <br><br>
                        <input type="text" name="author" class="form-control" placeholder="Author" />
                        <br><br>
                        <input type="submit" class="btn btn-lg btn-success" id="submitTestimonial" style="width:100%" value="Add Testimonial">
                        {!! Form::token() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">

        $('.addtestimonial').click(function (e){
            $('#testimonialModal').modal('show');
        });

        $('#form-testimonial').submit(function (e) {
            e.preventDefault();
            $('#addtestimonial').html('<i class="fa fa-spin fa-circle-o"></i>');
            $('#submitTestimonial').val('Please wait...');
            $.ajax({
                url: 'testimonials/save',
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
                                $('#addbanner').html('Add Testimonial');
                                $('#submitTestimonial').val('Add Testimonial');
                                window.location = data.redirect;
                            }
                            , 3000);
                    } else {
                        $.each(data.errors, function(i,val){
                            $('#addbanner').html('Add Testimonial');
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