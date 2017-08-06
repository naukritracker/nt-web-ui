<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Welcome to Naukri Tracker</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.ico') }}"> -->

        {!! Html::style('assets/css/bootstrap.min.css') !!}
        {!! Html::style('assets/css/font-awesome.min.css') !!}
        {!! Html::style('assets/css/animate.css') !!}
        {!! Html::style('assets/css/pnotify.custom.min.css') !!}
        {!! Html::style('assets/css/main.css') !!}

        <!-- Html5 shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <header>
            <div class="navbar navbar-default navbar-fixed-top top--header" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{URL::route('Home')}}" class="navbar-brand logo logo-top mar-t20 mar-b20">Naukri Tracker</a>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="container pad-t80">
        	<h2>Welcome to Naukri Tracker</h2>
        	<p>Here at <a href="{{ URL::route('Home') }}" target="_blank">Naukri Tracker</a>,
                we believe that the abilities of each and every individual has the potential to be utilized in the best possible manner. We live by this core concept and truly have faith
                that we can help you find that perfect fit for your team.
            </p>

        	<p>With that said, we would like to officially welcome you to <a href="{{ URL::route('Home') }}" target="_blank">Naukri Tracker</a>. Please click <a href="{{$link}}" target="_blank" style="color:green">here</a> or else use the link provided below to validate your email address so as to help us provide the latest opportunities best suited for your business.</p>

        	<br><br>

        	<div class="container text-center">
        		<h3><a href="{{$link}}" target="_blank">{{$link}}</a></h3>
        	</div>

        	<br><br><hr>
        	
        	<p><small><u>Disclaimer</u> : Privileged/Confidential information may be contained in this message and may be subject to legal privilege. Access to this e-mail by anyone other than the intended is unauthorised. If you are not the intended recipient (or responsible for delivery of the message to such person), you may not use, copy, distribute or deliver to anyone this message (or any part of its contents ) or take any action in reliance on it. In such case, you should destroy this message, and notify us immediately. If you have received this email in error, please notify us immediately by e-mail or telephone and delete the e-mail from any computer. If you or your employer does not consent to internet e-mail messages of this kind, please notify us immediately. All reasonable precautions have been taken to ensure no viruses are present in this e-mail. As our company cannot accept responsibility for any loss or damage arising from the use of this e-mail or attachments we recommend that you subject these to your virus checking procedures prior to use. The views, opinions, conclusions and other informations expressed in this electronic mail are not given or endorsed by the company unless otherwise indicated by an authorized representative independent of this message.</small></p>
        </div>

        <section class="footer-btm pad-b5">
            <div class="container sm-txtc">
                <p>&copy; 2016 naukritracker. All rights reserved.</p>
            </div>
        </section>

    </body>

</html>
