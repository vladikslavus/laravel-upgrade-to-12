@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="wrapper">
        <h1>Книга № {{ $id }}</h1>
        @if ($id == 57)
            <p>писят семь</p>
        @endif
        {{-- @foreach ($array as $key => $item)
               <p>{{ $key }}  {{ $item }}</p>
            @endforeach --}}

        @forelse ($array as $key => $item)
            <p>{{ $key }} {{ $item }}</p>
        @empty
            <p>Массив пустой!</p>
        @endforelse

    @empty($array)
        <p><b>Массив пустой!</b></p>
    @endempty
</div>
@endsection
