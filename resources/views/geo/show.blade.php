@extends('layouts.app')
@section('content')
    <div>
        @foreach ($geo as $info)
            <div>
                <div>{{$info['name']}}</div>
                <div>{{$info['description']}}</div>
            </div>
        @endforeach
    </div>
@endsection
