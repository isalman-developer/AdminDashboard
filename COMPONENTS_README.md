# Laravel Traditional Dashboard Layout

This project uses the **traditional Laravel approach** with `@extends`, `@section`, `@yield`, and `@include` partials.

## Traditional Laravel Usage

### Basic Dashboard Page
```blade
@extends('layouts.admin')

@section('title', 'My Dashboard')
@section('description', 'Dashboard description')

@section('content')
    <div class="row">
        <x-dashboard.sales-card 
            title="Today's Sales" 
            amount="$1,250" 
        />
        <x-dashboard.website-analytics :slides="$data" />
    </div>
@endsection
```

### With Custom Styles & Scripts
```blade
@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/custom-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/charts/charts.css') }}">
    <style>
        .custom-card { background: #f8f9fa; }
    </style>
@endsection

@section('content')
    <x-dashboard.earning-reports :metrics="$earnings" />
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard-init.js') }}"></script>
    <script src="{{ asset('js/analytics.js') }}"></script>
@endsection

@push('scripts')
    <script>
        // Inline JavaScript using @push
        console.log('Page loaded!');
        initializeDashboard();
    </script>
@endpush
```

## File Structure

### Traditional Laravel Structure
```
resources/views/
├── layouts/
│   └── admin.blade.php          # Main layout with @yield
├── partials/                    # Traditional partials
│   ├── sidebar.blade.php        # @include('partials.sidebar')
│   ├── navbar.blade.php         # @include('partials.navbar') 
│   ├── notifications.blade.php  # @include('partials.notifications')
│   ├── user-dropdown.blade.php  # @include('partials.user-dropdown')
│   └── footer.blade.php         # @include('partials.footer')
├── components/dashboard/        # Dashboard widget components
│   ├── website-analytics.blade.php
│   ├── sales-card.blade.php
│   ├── sales-overview.blade.php
│   ├── earning-reports.blade.php
│   ├── support-tracker.blade.php
│   ├── campaign-state.blade.php
│   └── source-visits.blade.php
└── welcome.blade.php           # Uses @extends('layouts.admin')
```

## Available Sections

### Layout Sections (@yield)
- `@yield('title')` - Page title
- `@yield('description')` - Meta description
- `@yield('content')` - Main page content
- `@yield('styles')` - Page-specific styles
- `@yield('scripts')` - Page-specific scripts

### Stack Sections (@stack)
- `@stack('styles')` - Additional styles using @push
- `@stack('scripts')` - Additional scripts using @push

## Dashboard Components
All dashboard components remain as Blade components:
- `<x-dashboard.website-analytics />` - Analytics carousel
- `<x-dashboard.sales-card />` - Sales metrics card
- `<x-dashboard.sales-overview />` - Sales comparison
- `<x-dashboard.earning-reports />` - Earnings with charts
- `<x-dashboard.support-tracker />` - Support statistics
- `<x-dashboard.campaign-state />` - Campaign metrics
- `<x-dashboard.source-visits />` - Traffic sources

## Traditional Laravel Benefits

1. **Laravel Standard** - Uses established Laravel templating patterns
2. **@section/@yield** - Full control over content sections
3. **@push/@stack** - Flexible script and style stacking
4. **@include partials** - Traditional partial inclusion
5. **Familiar** - Most Laravel developers know this approach
6. **Flexible** - Easy to override any section in child views

## Examples

### Conditional Scripts
```blade
@section('scripts')
    @if(auth()->check())
        <script src="{{ asset('js/authenticated.js') }}"></script>
    @endif
    
    @if(request()->is('dashboard/analytics'))
        <script src="{{ asset('js/analytics.js') }}"></script>
    @endif
@endsection
```

### Multiple Script Pushes
```blade
@push('scripts')
    <script>
        var userId = {{ auth()->id() }};
    </script>
@endpush

@push('scripts')
    <script>
        // Another script block
        initializeCharts();
    </script>
@endpush
```

### Dynamic Styles
```blade
@section('styles')
    @foreach($customStyles as $style)
        <link rel="stylesheet" href="{{ $style }}">
    @endforeach
@endsection
```

Clean, traditional Laravel approach! 🚀