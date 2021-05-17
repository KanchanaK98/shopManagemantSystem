@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('Welcome!') }}</h1>
                        <p class="text-lead text-light">
                            {{ __('Hello Everyone. This website was created by me, to seek and connect with the database of Shop. Also you can add, delete and update Shop\'s database using this website.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
