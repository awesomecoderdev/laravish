@extends('layouts.master')

@section('content')
    <div class="flex-center full-height">
        <div class="text--center">
            <h1 class="text--xl">Temp</h1>
            <h2 class="text--sm">Powered by Laravel {{ app()->version() }}</h2>
        </div>
    </div>
@endsection
