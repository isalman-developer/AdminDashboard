@php
    $toasts = [];
    foreach (['success', 'error', 'danger', 'warning', 'info'] as $type) {
        $value = session($type);
        if (! empty($value)) {
            $toasts[] = [
                'type'    => $type === 'danger' ? 'error' : $type,
                'message' => is_array($value) ? implode(' ', $value) : $value,
            ];
        }
    }
@endphp

@if (! empty($toasts))
        <div class="toast-container position-fixed top-5 end-0 p-3" style="z-index: 1090;">
        @foreach ($toasts as $index => $toast)
            @php
                $bgClass = 'bg-' . ($toast['type'] === 'error' ? 'danger' : ($toast['type'] === 'success' ? 'success' : ($toast['type'] === 'warning' ? 'warning' : 'info')));
            @endphp
            <div id="toast-{{ $index }}" 
                 class="bs-toast toast toast-ex my-2 fade align-items-center {{ $bgClass }} text-white border-0" 
                 role="alert" 
                 aria-live="assertive" 
                 aria-atomic="true"
                 data-bs-autohide="true"
                 data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body d-flex align-items-center gap-2">
                        <i class="icon-base ti 
                            @if ($toast['type'] === 'success') tabler-circle-check
                            @elseif ($toast['type'] === 'error') tabler-circle-x
                            @elseif ($toast['type'] === 'warning') tabler-alert-triangle
                            @else tabler-info-circle
                            @endif 
                            icon-sm"></i>
                        <span class="fw-medium">{{ $toast['message'] }}</span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endforeach
    </div>
@endif
