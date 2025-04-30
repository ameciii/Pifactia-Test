@extends('layouts.app')

@section('title', 'Audit Trail')
@section('page-title', 'Audit Trail')

@section('content')
<div class="content">
    <div class="card">

        {{-- Title --}}
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">Audit Trail</h2>

        {{-- Audit Table --}}
        <div class="overflow-x-auto">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f9fafb;">
                    <tr>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">No</th>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">User</th>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">Event</th>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">Model</th>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">Old Values</th>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">New Values</th>
                        <th style="padding: 12px; text-align: left; font-size: 0.8rem; font-weight: 600; color: #6b7280;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($audits as $index => $audit)
                        <tr style="background-color: {{ $index % 2 == 0 ? '#ffffff' : '#f3f4f6' }};">
                            <td style="padding: 12px;">{{ ($audits->currentPage() - 1) * $audits->perPage() + $index + 1 }}</td>
                            <td style="padding: 12px;">{{ $audit->user->name ?? 'Guest' }}</td>
                            <td style="padding: 12px;">
                                <span style="padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600;
                                    background-color: 
                                        @if($audit->event == 'created') #d1fae5 
                                        @elseif($audit->event == 'updated') #fef9c3 
                                        @elseif($audit->event == 'deleted') #fee2e2 
                                        @else #e5e7eb 
                                        @endif;
                                    color: 
                                        @if($audit->event == 'created') #065f46 
                                        @elseif($audit->event == 'updated') #92400e 
                                        @elseif($audit->event == 'deleted') #991b1b 
                                        @else #374151 
                                        @endif;">
                                    {{ ucfirst($audit->event) }}
                                </span>
                            </td>
                            <td style="padding: 12px;">{{ class_basename($audit->auditable_type) }}</td>
                            <td style="padding: 12px;">
                                <pre style="font-size: 12px; color: #374151; white-space: pre-wrap;">{{ json_encode($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </td>
                            <td style="padding: 12px;">
                                <pre style="font-size: 12px; color: #374151; white-space: pre-wrap;">{{ json_encode($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </td>
                            <td style="padding: 12px;">{{ $audit->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #6b7280;">No audit logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top: 20px;">
            {{ $audits->links() }}
        </div>

    </div>
</div>
@endsection
