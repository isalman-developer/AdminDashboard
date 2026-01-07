@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')
@section('description', 'Admin dashboard for Bootstrap admin template')

@section('styles')
    <!-- Page specific styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-advance.css') }}">
@endsection

@section('content')

    <div class="row g-6">
        <!-- Website Analytics -->
        <x-dashboard.website-analytics 
            :slides="[
                [
                    'title' => 'Website Analytics',
                    'subtitle' => 'Total 28.5% Conversion Rate',
                    'section_title' => 'Traffic',
                    'left_stats' => [
                        ['value' => '28%', 'label' => 'Sessions'],
                        ['value' => '1.2k', 'label' => 'Leads']
                    ],
                    'right_stats' => [
                        ['value' => '3.1k', 'label' => 'Page Views'],
                        ['value' => '12%', 'label' => 'Conversions']
                    ],
                    'image' => 'admin/assets/img/illustrations/card-website-analytics-1.png'
                ],
                [
                    'title' => 'Website Analytics',
                    'subtitle' => 'Total 28.5% Conversion Rate',
                    'section_title' => 'Spending',
                    'left_stats' => [
                        ['value' => '12h', 'label' => 'Spend'],
                        ['value' => '127', 'label' => 'Order']
                    ],
                    'right_stats' => [
                        ['value' => '18', 'label' => 'Order Size'],
                        ['value' => '2.3k', 'label' => 'Items']
                    ],
                    'image' => 'admin/assets/img/illustrations/card-website-analytics-2.png'
                ],
                [
                    'title' => 'Website Analytics',
                    'subtitle' => 'Total 28.5% Conversion Rate',
                    'section_title' => 'Revenue Sources',
                    'left_stats' => [
                        ['value' => '268', 'label' => 'Direct'],
                        ['value' => '62', 'label' => 'Referral']
                    ],
                    'right_stats' => [
                        ['value' => '890', 'label' => 'Organic'],
                        ['value' => '1.2k', 'label' => 'Campaign']
                    ],
                    'image' => 'admin/assets/img/illustrations/card-website-analytics-3.png'
                ]
            ]"
        />

        <!-- Average Daily Sales -->
        <x-dashboard.sales-card 
            title="Average Daily Sales"
            subtitle="Total Sales This Month"
            amount="$28,450"
            chartId="averageDailySales"
        />

        <!-- Sales Overview -->
        <x-dashboard.sales-overview 
            title="Sales Overview"
            amount="$42.5k"
            changePercentage="+18.2%"
            changeColor="success"
            :leftMetric="[
                'label' => 'Order',
                'percentage' => '62.2%',
                'count' => '6,440',
                'color' => 'info',
                'icon' => 'tabler-shopping-cart',
                'progress' => '70%'
            ]"
            :rightMetric="[
                'label' => 'Visits',
                'percentage' => '25.5%',
                'count' => '12,749',
                'color' => 'primary',
                'icon' => 'tabler-link',
                'progress' => '30%'
            ]"
        />

        <!-- Earning Reports -->
        <x-dashboard.earning-reports
            title="Earning Reports"
            subtitle="Weekly Earnings Overview"
            earnings="$468"
            changePercentage="+4.2%"
            changeColor="success"
            description="You informed of this week compared to last week"
            chartId="weeklyEarningReports"
            dropdownId="earningReportsId"
            :metrics="[
                [
                    'label' => 'Earnings',
                    'value' => '$545.69',
                    'color' => 'primary',
                    'icon' => 'tabler-currency-dollar',
                    'progress' => '65%'
                ],
                [
                    'label' => 'Profit',
                    'value' => '$256.34',
                    'color' => 'info',
                    'icon' => 'tabler-chart-pie-2',
                    'progress' => '50%'
                ],
                [
                    'label' => 'Expense',
                    'value' => '$74.19',
                    'color' => 'danger',
                    'icon' => 'tabler-brand-paypal',
                    'progress' => '65%'
                ]
            ]"
        />

        <!-- Support Tracker -->
        <x-dashboard.support-tracker
            title="Support Tracker"
            subtitle="Last 7 Days"
            totalTickets="164"
            chartId="supportTracker"
            dropdownId="supportTrackerMenu"
            :stats="[
                [
                    'label' => 'New Tickets',
                    'value' => '142',
                    'color' => 'primary',
                    'icon' => 'tabler-ticket'
                ],
                [
                    'label' => 'Open Tickets',
                    'value' => '28',
                    'color' => 'info',
                    'icon' => 'tabler-circle-check'
                ],
                [
                    'label' => 'Response Time',
                    'value' => '1 Day',
                    'color' => 'warning',
                    'icon' => 'tabler-clock'
                ]
            ]"
        />

        <!-- Total Earning -->
        <x-dashboard.total-earning
            title="Total Earning"
            percentage="87%"
            changeValue="25.8%"
            changeColor="success"
            chartId="totalEarningChart"
            dropdownId="totalEarning"
            :items="[
                [
                    'title' => 'Total Revenue',
                    'description' => 'Client Payment',
                    'value' => '+$126',
                    'valueColor' => 'success',
                    'color' => 'primary',
                    'icon' => 'tabler-brand-paypal'
                ],
                [
                    'title' => 'Total Sales',
                    'description' => 'Refund',
                    'value' => '+$98',
                    'valueColor' => 'success',
                    'color' => 'secondary',
                    'icon' => 'tabler-currency-dollar'
                ]
            ]"
        />

        <!-- Monthly Campaign State -->
        <x-dashboard.campaign-state
            title="Monthly Campaign State"
            subtitle="8.52k Social Visitors"
            dropdownId="MonthlyCampaign"
            :stats="[
                [
                    'label' => 'Emails',
                    'value' => '12,346',
                    'change' => '0.3%',
                    'changeColor' => 'success',
                    'color' => 'success',
                    'icon' => 'tabler-mail'
                ],
                [
                    'label' => 'Opened',
                    'value' => '8,734',
                    'change' => '2.1%',
                    'changeColor' => 'success',
                    'color' => 'info',
                    'icon' => 'tabler-link'
                ],
                [
                    'label' => 'Clicked',
                    'value' => '967',
                    'change' => '1.4%',
                    'changeColor' => 'danger',
                    'color' => 'warning',
                    'icon' => 'tabler-mouse'
                ],
                [
                    'label' => 'Subscribe',
                    'value' => '345',
                    'change' => '8.5%',
                    'changeColor' => 'success',
                    'color' => 'primary',
                    'icon' => 'tabler-users'
                ],
                [
                    'label' => 'Complaints',
                    'value' => '10',
                    'change' => '1.5%',
                    'changeColor' => 'danger',
                    'color' => 'secondary',
                    'icon' => 'tabler-alert-triangle'
                ],
                [
                    'label' => 'Unsubscribe',
                    'value' => '86',
                    'change' => '0.8%',
                    'changeColor' => 'success',
                    'color' => 'danger',
                    'icon' => 'tabler-ban'
                ]
            ]"
        />

        <!-- Source Visit -->
        <x-dashboard.source-visits
            title="Source Visits"
            subtitle="38.4k Visitors"
            dropdownId="sourceVisits"
            :sources="[
                [
                    'title' => 'Direct Source',
                    'description' => 'Direct link click',
                    'value' => '1.2k',
                    'change' => '+4.2%',
                    'changeColor' => 'success',
                    'color' => 'secondary',
                    'icon' => 'tabler-shadow'
                ],
                [
                    'title' => 'Social Network',
                    'description' => 'Social Channels',
                    'value' => '31.5k',
                    'change' => '+8.2%',
                    'changeColor' => 'success',
                    'color' => 'secondary',
                    'icon' => 'tabler-globe'
                ],
                [
                    'title' => 'Email Newsletter',
                    'description' => 'Mail Campaigns',
                    'value' => '893',
                    'change' => '+2.4%',
                    'changeColor' => 'success',
                    'color' => 'secondary',
                    'icon' => 'tabler-mail'
                ],
                [
                    'title' => 'Referrals',
                    'description' => 'Impact Radius Visits',
                    'value' => '342',
                    'change' => '-0.4%',
                    'changeColor' => 'danger',
                    'color' => 'secondary',
                    'icon' => 'tabler-external-link'
                ],
                [
                    'title' => 'ADVT',
                    'description' => 'Google ADVT',
                    'value' => '2.15k',
                    'change' => '+9.1%',
                    'changeColor' => 'success',
                    'color' => 'secondary',
                    'icon' => 'tabler-ad'
                ],
                [
                    'title' => 'Other',
                    'description' => 'Many Sources',
                    'value' => '12.5k',
                    'change' => '+6.2%',
                    'changeColor' => 'success',
                    'color' => 'secondary',
                    'icon' => 'tabler-star'
                ]
            ]"
        />
    </div>
@endsection

@section('scripts')
    <!-- Page specific scripts -->
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded and ready!');
        });
    </script>
@endpush