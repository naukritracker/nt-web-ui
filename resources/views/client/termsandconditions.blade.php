@extends('templates.client.master')

@section('title')
@parent
 - Terms and Conditions
@stop

@section('meta')
  @parent
  <meta name="keywords" content="Naukri Tracker, Terms and Conditions, T&C, Rules">
  <meta name="description" content="Terms and Conditions for Naukri Tracker services. Please view our T&C's page to know more.">
  <meta name="robots" content="index/nofollow">
@stop

@section('content')
<div class="container pad-t85 mar-t20">
    <div class="row mar-b20">
        <div class="col-sm-9">
            <h3 class="pad-t20"><b>Privacy Policy - Privacy Rights</b></h3>

            <h4 class="pad-t20"><b><u>Introduction</u></b></h4>

            <p>We, at <strong>KASA Networks</strong> are committed to respect your online privacy and recognize your need for appropriate protection and management of any personally identifiable information (<i>Personal Information</i>) you share with us. We collect this information to help fetching a <i>Right job to the Right Candidates</i> as we quote.</p>

            <p>We suggest to read out the complete policy and understand how we shall be collecting your personal & professional information you shared on the site or any application respectively.</p>

            <h4 class="pad-t20"><b><u>Age Clause</u></b></h4>
            <p><strong>KASA Networks</strong> will not contact children under age 13 about special offers or for marketing purposes without a parent's permission. And don’t offer any Job to the candidates below 18 years as per the Child labor act.</p>

            <h4 class="pad-t20"><b><u>Information Collection</u></b></h4>
            <p>We collect information when you use <strong><i><a href="{!!URL::route('Home')!!}">naukritracker.com</a></i></strong>, we collect information such as contact details, profile information you update & resume provided which may not be limited.
We might also collect other information including technical or device used to access our site, contact lists and user too. And you might also be asked to compete a registration form and validate it to offer you a personalized browsing experience.</p>

            <h4 class="pad-t20"><b><u>Information Usage</u></b></h4>
            <p>We will be using the information collected to delivery high quality services to our prospect candidates and high quality material to your business partners and associates. ( Read clause - <b><u><a href="#3rdpartyclause">Third Party services Information sharing & Disclosure</a></u></b>).</p>

            <p>The information shall be use to deliver the services and products, to communicate ,to operate and keep our site and applications upgraded. Any data update in the profile database and marked visible shall be accessed, used and stored by others around the world. Posting of any sensitive information to <strong><i><a href="{!!URL::route('Home')!!}">naukritracker.com</a></i></strong> is not recommended. Though we ensure to provide secured environment by allowing limited access our database to other users , we do not guarantee that the unauthorized parties will not gain access. </p>

            <p>We limit access to personal information about you to employees & Employers  who we believe reasonably need to come into contact with that information to provide products or services to you or in order to do their jobs.</p>

            <h4 class="pad-t20"><b><u>Information Sharing & Disclosure</u></b></h4>
            <p><strong>KASA Networks</strong> does not sell , rent or share your personal information to any person or non- affiliated organization and companies except to provide services and products you have opted for with your permission or under the below mentioned circumstances.</p>

            <ul class="mar-l30" style="list-style-type: circle;">
              <li class="pad-b5">We provide the information to trusted partners who work on behalf of or with <strong>KASA Networks</strong> under confidentiality agreements. And these companies do not have any rights to share the same with others.</li>
              <li class="pad-b5"><span id="3rdpartyclause">We do not share contact information with third parties for their direct marketing purposes without your consent.</span></li>
              <li class="pad-b5">We may share information to third parties if you consent. For example, we may use your information to contact you about products or services available from <strong><i><a href="{!!URL::route('Home')!!}">naukritracker.com</a></i></strong> or our affiliates. If you opt in, we may supply your information to third parties who may contact you about their products or services. You may change your contact preferences by adjusting your notification settings.</li>
              <li class="pad-b5">We may disclose to third parties information that we have collected from other websites.</li>
              <li class="pad-b5">We disclose information where legally required.</li>
              <li class="pad-b5">We may disclose and transfer information to a third party who acquires any or all of Naukritracker's business units.</li>
              <li class="pad-b5"><strong>KASA Networks</strong> does not provide any personal information to the advertiser when you interact with or view a targeted ad.</li>
              <li class="pad-b5">We transfer information about you if <strong>KASA Networks</strong> is acquired by or merged with another company. In this event <strong>KASA Networks</strong> will notify you before information about you is transferred and becomes subject to a different privacy policy.</li>
            </ul>

            <p class="pad-t20">We at <strong>KASA Networks</strong> ensure the authenticity & accuracy of the data & information shared on <strong><i><a href="{!!URL::route('Home')!!}">naukritracker.com</a></i></strong></p>

            <h4 class="pad-t20"><b><u>Contact Details</u></b></h4>
            <p><strong>KASA Networks</strong> is contactable online for any concerns and questions related to our privacy policy.</p>

            <p>You may also write to us at :</p>

            <p><small><strong># 3445, 3rd Floor Block-C,<br />
            4th Cross, 10th Main<br />
            Indira Nagar 2nd Stage,<br />
            Bangalore-560038.</strong></small></p>

        </div>


        @include('client.partials.latestjobsinner') 
    </div>
</div>
@stop
