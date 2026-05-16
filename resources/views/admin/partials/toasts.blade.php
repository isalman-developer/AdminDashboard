@php
    $toasts = [];
    foreach (['success', 'error', 'danger', 'warning', 'info'] as $type) {
        try {
            $value = session($type);
        } catch (\Throwable $e) {
            $value = null;
        }
        if (! empty($value)) {
            $toasts[] = [
                'type' => $type === 'danger' ? 'error' : $type,
                'message' => is_array($value) ? implode(' ', $value) : $value,
            ];
        }
    }
@endphp

@if (! empty($toasts))
    <div class="toast-container-wrapper position-fixed top-0 end-0 p-3" style="z-index: 1070;">
        <div class="toast-container">
            @foreach ($toasts as $index => $toast)
                <div class="toast fade"
                     id="toast-{{ $index }}"
                     role="alert"
                     aria-live="assertive"
                     aria-atomic="true"
                     data-bs-delay="5000"
                     data-autodismiss="true"
                     style="min-width: 320px;">
                    <div class="toast-header
                        @if ($toast['type'] === 'success')
                            border-success text-success
                        @elseif ($toast['type'] === 'error')
                            border-danger text-danger
                        @elseif ($toast['type'] === 'warning')
                            border-warning text-warning
                        @else
                            border-info text-info
                        @endif
                        bg-body
                    ">
                        <i class="icon-base me-2
                            @if ($toast['type'] === 'success') ti tabler-circle-check
                            @elseif ($toast['type'] === 'error') ti tabler-circle-x
                            @elseif ($toast['type'] === 'warning') ti tabler-alert-triangle
                            @else ti tabler-info-circle
                            @endif
                        "></i>
                        <strong class="me-auto">{{ ucfirst($toast['type']) }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ $toast['message'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
