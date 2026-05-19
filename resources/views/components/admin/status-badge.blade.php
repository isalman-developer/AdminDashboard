@props(['active'])
<span class="badge bg-label-{{ $active ? 'success' : 'secondary' }}">
    {{ $active ? 'Active' : 'Inactive' }}
</span>
