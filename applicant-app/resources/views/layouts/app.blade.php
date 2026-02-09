<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTDC Prototype</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite('resources/css/app.css')

</head>
<body>

{{--HEADER--}}
<header class="main-header">
    <div class="header-left">
        <img src="{{ asset('images/mtdc-logo.png') }}" class="mtdc-logo">

        <div class="header-title">
            Malaysian Technology Development Corporation
        </div>
    </div>

<<<<<<< HEAD
    <a href="{{ route('applicants.create') }}">Add Data</a>
    <a href="{{ route('applicants.search') }}">Applicant Search</a>
    <a href="{{ route('participants.search') }}">Participant Search</a>
    <a href="{{ route('applicants.charts') }}">Charts Page</a>
=======
    <a href="{{ route('participants.create') }}">Add Data</a>
>>>>>>> c87aa40 (Work in progress for huda-dev)

    <div class="header-right">
        <div class="profile-icon" id="profileToggle">
            <i class="fa fa-user-circle-o"></i>
        </div>

        <div class="profile-dropdown" id="profileMenu">
            <a href="{{ route('profile.edit') }}">Profile Info</a>

            {{-- Logout link --}}
            <a href="#"
            class="dropdown-link-btn"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Log Out
            </a>

            {{-- Hidden logout form --}}
            <form id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none;">
                @csrf
            </form>
        </div>
    </div>

</header>


<div class="container">
    @yield('content')
</div>


<script>
document.getElementById('profileToggle').addEventListener('click', function (e) {
    e.stopPropagation();
    document.getElementById('profileMenu').classList.toggle('show');
});

// close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.header-right')) {
        document.getElementById('profileMenu').classList.remove('show');
    }
});
</script>

</body>
</html>

