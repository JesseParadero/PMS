@extends('layouts.userlayout.app')
@section('bodyClass', 'dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-center">
            @php
                $user_details = Auth::user();
            @endphp
            <div class="text-center mt-5">
                <h1>Hello {{ ucfirst($user_details->firstname) . ' ' . ucfirst($user_details->lastname) }}</h1>
                <span id="datetime-container"></span>
            </div>
        </div>
    </div>
    <script>
        function updateDateTime() {
            var container = document.getElementById('datetime-container');
            var now = new Date();
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            var formattedDateTime = now.toLocaleDateString('en-US', options);

            container.textContent = formattedDateTime;
        }
        setInterval(updateDateTime, 1000);
        window.onload = updateDateTime;
    </script>
@endsection
