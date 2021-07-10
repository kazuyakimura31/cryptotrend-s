@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Drill Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('coins.index') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            </div>

                            @for ($i = 1; $i <= 10; $i++)
                                <div class="form-group row">
                                    <label for="problem0" class="col-md-4 col-form-label text-md-right">{{ __('Problem').$i }}</label>
                                </div>
                            @endfor

                            <div>{{ $hour }}</div>
                            <div>{{ $day }}</div>
                            <div>{{ $week }}</div>
                            <div>{{ $highlow }}</div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection