@extends('layouts.app')
@section('content')
    <div class="py-4"></div>
    <div class="container">
        <div class="text-center">
            <p class="display-5"><b>OUR AMAZING TEAM</b></p>
            <p><i>Lorem ipsum dolor sit amet consectetur.</i></p>
            <div class="row justify-content-center">
                <div class="col-lg-4 ">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="{{ asset('images/who/1.jpg')}}"/>
                        <h4 class=>Carolina Hernandez</h4>
                        <p class="text-muted">Student</p>
                    </div>
                    <div class="social py-4 ">
                        <a href="https://www.instagram.com/gcarolina03/"><img class="btn btn-social mx-2" src="{{ asset('images/svg/instagram.svg') }}"/></a>
                        <a href="https://www.facebook.com/gcarolina03/"><img class="btn btn-social mx-2" src="{{ asset('images/svg/facebook.svg') }}"/></a>
                        <a href="https://www.linkedin.com/in/gloria-carolina-hernandez/"><img class="btn btn-social mx-1" src="{{ asset('images/svg/linkedin.svg') }}"/></a>
                        <a href="https://github.com/gcarolina03"><img class="btn btn-social mx-1" src="{{ asset('images/svg/github.svg') }}"/></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
        </div>
    </div>
@endsection
