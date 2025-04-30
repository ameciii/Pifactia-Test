<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Pifacia</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

<div class="flex-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Pifacia Group</h2>
        <nav>
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
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
                    <span>Log out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Topbar -->
        <div class="topbar">
            <h1>Dashboard</h1>
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

        <!-- Content -->
        <div class="content">
            <div class="cards">
                <div class="card">
                    <h3>Total Users</h3>
                    <p>{{ $totalUsers }}</p>
                </div>
                <div class="card">
                    <h3>Total Products</h3>
                    <p>{{ $totalProducts }}</p>
                </div>
                <div class="card">
                    <h3>Categories</h3>
                    <p>{{ $totalCategories }}</p>
                </div>
                <div class="card">
                    <h3>Transactions</h3>
                    <p>{{ $totalTransactions }}</p>
                </div>
            </div>

            <div class="activity">
                <h2>Recent Activity</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>User</th>
                            <th>Table</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAudits as $audit)
                        <tr>
                            <td>{{ $audit->event }}</td>
                            <td>{{ $audit->user ? $audit->user->name : '-' }}</td>
                            <td>{{ str_replace('App\\Models\\', '', $audit->auditable_type) }}</td>
                            <td>{{ $audit->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No activity found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</body>
</html>
