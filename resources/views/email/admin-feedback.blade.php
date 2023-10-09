<h1>
    {{__('Found feedback')}}
</h1>

<h1>{{__('Data')}}</h1>

@foreach ($request as $name => $item)
    <h2>{{ ucfirst($name) }} : {{ ucfirst($item) }}</h2>
    <br>
@endforeach

<br>
<br>
