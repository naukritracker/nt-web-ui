@extends('templates.client.master')

@section('content')
    <div class="container">
        <div class="row mar-b20 pad-t85 mar-t20">
            <div class="col-sm-3">
                @include('client.partials.employerprofilenavigation')
            </div>
            <div class="col-sm-9">
                <div class="clearfix mar-t20">
                    <div class="col-sm-12">
                        <h4 class="sm-title mar-t10 mar-b15" id="employerModalLabel">Post a Job</h4>
                    </div>
                    <div class="col-sm-12" id="employerModalBody">
                        <div class="clearfix">
                            <div class="clearfix pad-t25pr pad-l50pr">
                                <i class="fa fa-circle-o-notch fa-spin green"></i>
                                <i class="fa fa-circle-o-notch fa-spin red"></i>
                                <i class="fa fa-circle-o-notch fa-spin blue"></i>
                                <p><b>Loading...</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    {!! Html::script('assets/js/jquery.validate.min.js') !!}
    {!! Html::script('assets/unisharp/laravel-ckeditor/ckeditor.js') !!}
    <script type="text/javascript">
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }
        $(document).ready(function () {
            var edit = getUrlParameter('edit');
            var copy = getUrlParameter('copy');
            var url = '';
            var modifier = '';
            var title = '';
            if (edit) {
                url = 'async/loadpostajob' + '/' + edit + '/edit';
                modifier = edit;
                title = 'Edit Job';
            } else if (copy) {
                url = 'async/loadpostajob' + '/' + copy + '/copy';
                modifier = copy;
                title = 'Copy Job';
            } else {
                url = 'async/loadpostajob';
                title = 'Post new Job';
            }
            $.post(
                url,
                {_token: token},
                function (data) {
                    $('#employerModalLabel').html(title);
                    $('#employerModalBody').html(data);
                    if (modifier != '') {
                        secondaryurl = 'async/loadcountryrelateddata/'
                            + $('#country_id').val()
                            + '/' + modifier;
                        $.post(secondaryurl, {_token: token}, function (data) {
                            $('#state_id').html(data.states);
                            $('#visa_id').html(data.visas);
                        }).fail(function () {
                            var notice = new PNotify({
                                title: 'Error',
                                text: 'We were unable to retrieve form data from our servers.',
                                type: 'error',
                                buttons: {
                                    closer: false,
                                    sticker: false
                                }
                            });

                            notice.get().click(function () {
                                notice.remove();
                            });
                        });
                    }
                    $('#country_id').on('click change', function () {
                        if ($(this).val()) {
                            $.post('async/loadcountryrelateddata/' + $(this).val(), {_token: token}, function (data) {
                                $('#state_id').html(data.states);
                                $('#visa_id').html(data.visas);
                            }).fail(function () {
                                var notice = new PNotify({
                                    title: 'Error',
                                    text: 'We were unable to retrieve form data from our servers.',
                                    type: 'error',
                                    buttons: {
                                        closer: false,
                                        sticker: false
                                    }
                                });

                                notice.get().click(function () {
                                    notice.remove();
                                });
                            });
                        }
                    });
                    CKEDITOR.replace('description');
                    CKEDITOR.instances['description'].on('focus', function (evt) {
                        if (isFirst) {
                            isFirst = 0;
                            CKEDITOR.instances['description'].setData('');
                        }
                    });
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                if (jqXHR.status == 401) {
                    new PNotify({
                        title: 'Unauthorized !',
                        text: 'Please <a href="show/login">login</a> to access this section',
                        type: 'warning'
                    });
                } else {
                    new PNotify({
                        title: 'Error',
                        text: 'We were unable to retrieve search data from our servers. Refresh the page to try again.',
                        type: 'error',
                    });
                }
            });
        });
    </script>
@stop
