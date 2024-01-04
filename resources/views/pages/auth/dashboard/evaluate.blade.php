@extends('layouts.userlayout.app')
@push('css')
    <link href="{{ rspr::vers('css/page/evaluation.css') }}" rel="stylesheet" />
@endpush
@section('bodyClass', 'dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')
@section('content')
    <div class="container-fluid">
        <div id="spinner-overlay" class="text-center align-items-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">loading...</span>
            </div>
        </div>
        <div class="card" style="width:30%;">
            <div class="card-body">
                <p>Employee Name: <b>{{ ucfirst($user->firstname) . ' ' . ucfirst($user->lastname) }}</b></p>
                <p>Project/Team :</p>
                <p>Position : @if ($user->role == 0)
                        INVALID
                    @elseif($user->role == 1)
                        Junior Software Engineer
                    @elseif($user->role == 2)
                        Senior Software Engineer
                    @elseif($user->role == 3)
                        CEO
                    @endif
                </p>
                <p>Team Leader(s) :</p>
                <p>Current Level:</p>
                <p>Technical Skills [Out of 100pts]:</p>
                <p>Professional Development:</p>
            </div>
        </div>

        <div id="programmingLangauge"></div>
        <div id="cardTable"></div>
    </div>
    <script>
        var fetchProgrammingLanguage = "{{ route(__('messages.evaluate.languages')) }}";
        var fetchLevelItem = "{{ route(__('messages.evaluate.LevelItem'), ['id' => ':id']) }}";
        var fetchRating = "{{ route(__('messages.evaluate.rating'), ['ratings' => ':id']) }}";
    </script>
    <script src="{{ rspr::vers('js/page/Evaluation.js') }}" defer></script>
@endsection
