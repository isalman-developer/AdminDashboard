<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'MLM Admin Dashboard',
            ],
            [
                'key' => 'support_email',
                'value' => 'support@example.com',
            ],
            [
                'key' => 'timezone',
                'value' => 'UTC',
            ],
            [
                'key' => 'date_format',
                'value' => 'Y-m-d',
            ],

            // Commission Settings
            [
                'key' => 'commission_rate',
                'value' => '10',
            ],
            [
                'key' => 'max_commission_levels',
                'value' => '5',
            ],
            [
                'key' => 'level_commission_rates',
                'value' => json_encode([1 => 10, 2 => 5, 3 => 3, 4 => 2, 5 => 1]),
            ],
            [
                'key' => 'enable_dynamic_commission',
                'value' => '0',
            ],

            // User Registration Settings
            [
                'key' => 'allow_self_referral',
                'value' => '0',
            ],
            [
                'key' => 'max_referral_level',
                'value' => '10',
            ],
            [
                'key' => 'require_email_verification',
                'value' => '1',
            ],

            // Wallet & Payment Settings
            [
                'key' => 'currency',
                'value' => 'USD',
            ],
            [
                'key' => 'currency_symbol',
                'value' => '$',
            ],
            [
                'key' => 'minimum_withdrawal',
                'value' => '50',
            ],
            [
                'key' => 'withdrawal_fee_percentage',
                'value' => '2.5',
            ],
            [
                'key' => 'allow_wallet_topup',
                'value' => '0',
            ],

            // Security Settings
            [
                'key' => 'max_login_attempts',
                'value' => '5',
            ],
            [
                'key' => 'lockout_time_minutes',
                'value' => '15',
            ],

            // Notification Settings
            [
                'key' => 'notify_referral_signup',
                'value' => '1',
            ],
            [
                'key' => 'notify_commission_earned',
                'value' => '1',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
