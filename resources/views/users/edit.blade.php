@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Add New User')
@section('page-title', isset($user) ? 'Edit User' : 'Add New User')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 2rem;">
        
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 2rem;">
            {{ isset($user) ? 'Edit User' : 'Add New User' }}
        </h2>

        @if ($errors->any())
            <div style="margin-bottom: 1rem; padding: 1rem; background-color: #fee2e2; color: #991b1b; border-radius: 8px;">
                <ul style="list-style-type: disc; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            <div>
                <label for="name" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;" required>
            </div>

            <div>
                <label for="email" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;" required>
            </div>

            @if (!isset($user))
            <div>
                <label for="password" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Password</label>
                <input type="password" id="password" name="password" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;" required>
            </div>

            <div>
                <label for="password_confirmation" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;" required>
            </div>
            @endif

            <div>
                <label for="role_id" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Role</label>
                <select name="role_id" id="role_id" required
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;">
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ (isset($user) && $user->role_id == $role->id) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                <a href="{{ route('users.index') }}" 
                    style="padding: 0.8rem 1.5rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px; background-color: #f9fafb; color: #374151; text-decoration: none;">
                    Cancel
                </a>
                <button type="submit" 
                    style="padding: 0.8rem 1.5rem; border-radius: 8px; background-color: #6366f1; color: white; font-size: 15px; font-weight: 600; border: none;">
                    {{ isset($user) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>

        @if(isset($user) && $user->audits->count())
            <div style="margin-top: 3rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem;">History & Note</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #f9fafb;">
                            <tr>
                                <th style="padding: 10px; font-size: 0.85rem;">Date</th>
                                <th style="padding: 10px; font-size: 0.85rem;">Action</th>
                                <th style="padding: 10px; font-size: 0.85rem;">User</th>
                                <th style="padding: 10px; font-size: 0.85rem;">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->audits as $audit)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 10px;">{{ $audit->created_at->format('d-m-Y H:i') }}</td>
                                    <td style="padding: 10px;">{{ ucfirst($audit->event) }}</td>
                                    <td style="padding: 10px;">{{ $audit->user->name ?? 'Guest' }}</td>
                                    <td style="padding: 10px;">-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
