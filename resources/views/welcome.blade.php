@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="wrapper">
        <h1>Ссылки</h1>
        <ul class="list">
            <li><a href="/books" class="list__link">Книги</a></li>
            <li><a href="/books/insert/2" class="list__link">Добавить книгу по id автора = 2</a></li>
            <hr>
            <li><a href="/login" class="list__link">loginForm</a></li>
            <li><a href="/register" class="list__link">registerForm</a></li>
            <li><a href="/profile" class="list__link">profile</a></li>
            <li><a href="/change-password" class="list__link">showChangePasswordForm</a></li>
            <hr>
            <li><a href="/api/books" class="list__link">[ApiBookController::class, 'index']</a></li>
            <li><a href="/api/books/5" class="list__link">[ApiBookController::class, 'show']</a></li>
            <hr>
            <li><a href="/latest-grade" class="list__link">latestGradeRelation</a></li>
            <li><a href="/first-grade" class="list__link">firstGradeRelation</a></li>
            <li><a href="/highest-grade" class="list__link">highestGradeRelation</a></li>
            <li><a href="/lowest-grade" class="list__link">lowestGradeRelation</a></li>
            <li><a href="/latest-valid-grade" class="list__link">latestValidGradeRelation</a></li>
            <hr>
            <li><a href="/show-monitor-by-teacher" class="list__link">showMonitorByTeacher (Has One Through)</a></li>
            <li><a href="/show-city-books/1" class="list__link">showCityBooks (Has Many Through )</a></li>
            <li><a href="/show-city-books-titles/1" class="list__link">showCityBooksTitles (Has Many Through)</a></li>
        </ul>
    </div>
@endsection
