@extends('layouts.app')

@section('content')
<section class="py-4 container">
    @if (session()->has('status'))
    <div class="w-1/2 border border-green-600 p-2 rounded">
        <p class="text-green-600 font-semibold text-center">{{ session()->get('status') }}</p>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
