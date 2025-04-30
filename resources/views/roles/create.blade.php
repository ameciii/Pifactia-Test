@extends('layouts.app')

@section('title', isset($role) ? 'Edit Role' : 'Add New Role')
@section('page-title', 'Role Management')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem;">

        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
            {{ isset($role) ? 'Edit Role' : 'Add New Role' }}
        </h2>

        @if ($errors->any())
            <div style="margin-bottom: 20px; padding: 10px; background-color: #fee2e2; color: #991b1b; border-radius: 8px;">
                <ul style="list-style: disc; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.2rem;">
            @csrf
            @if (isset($role))
                @method('PUT')
            @endif

            <div>
                <label for="name" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Role Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label for="description" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Description</label>
                <input type="text" id="description" name="description" value="{{ old('description', $role->description ?? '') }}"
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
                <a href="{{ route('roles.index') }}"
                    style="padding: 10px 20px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #374151; background: #f9fafb; text-decoration: none;">Cancel</a>
                <button type="submit"
                    style="padding: 10px 20px; border-radius: 8px; background-color: #4f46e5; color: white; font-size: 14px; font-weight: 600; border: none;">
                    {{ isset($role) ? 'Update' : 'Save' }}
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
