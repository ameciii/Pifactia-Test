<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Pifacia</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

<div class="flex-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Pifacia Group</h2>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('users.index') }}">User Management</a>
            <a href="{{ route('roles.index') }}">Role Management</a>
            <a href="{{ route('categories.index') }}">Category Management</a>
            <a href="{{ route('products.index') }}">Product Management</a>
            <a href="{{ route('transactions.index') }}">Transaction Management</a>
            <a href="{{ route('audits.index') }}">Audit Trail</a>
        </nav>
        <div class="logout-section">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <svg class="logout-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 002 2h3a2 2 0 002-2v-1m-7-4V7a2 2 0 012-2h3a2 2 0 012 2v1" />
                    </svg>
                    Log out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h1>@yield('page-title')</h1>
            <div class="profile">
                <span>{{ Auth::user()->name }}</span>
                <div class="profile-icon">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A8 8 0 0112 16a8 8 0 016.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Content isi setiap page -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
