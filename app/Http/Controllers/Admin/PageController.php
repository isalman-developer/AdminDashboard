<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private SettingService $settings) {}

    public function editAbout(): View
    {
        $data = [
            'about_story_heading'   => setting('about_story_heading', 'About Us'),
'about_story_sub_heading'   => setting('about_story_sub_heading', 'Welcome to Electronic World'),
            'about_story_body'      => setting('about_story_body', 'We started with a simple idea: make great products accessible to everyone. Over the years we have grown into a trusted brand with customers across the globe.'),
            'about_stat_1_number'   => setting('about_stat_1_number', '10 Years'),
            'about_stat_1_label'    => setting('about_stat_1_label', 'In business'),
            'about_stat_2_number'   => setting('about_stat_2_number', '1000+'),
            'about_stat_2_label'    => setting('about_stat_2_label', 'Happy customers'),
            'about_stat_3_number'   => setting('about_stat_3_number', '4500+'),
            'about_stat_3_label'    => setting('about_stat_3_label', 'Products sold'),
            'about_stat_4_number'   => setting('about_stat_4_number', '25+'),
            'about_stat_4_label'    => setting('about_stat_4_label', 'Stores worldwide'),
            'about_feature_nation_wide_delivery'    => setting('about_feature_nation_wide_delivery', 'Nationwide Delivery'),
            'about_feature_nation_wide_delivery_text'    => setting('about_feature_nation_wide_delivery_text', 'Nationwide Delivery'),
            'about_feature_nation_help_center'    => setting('about_feature_nation_help_center', '24/7 Help Center'),
            'about_feature_nation_help_center_text'    => setting('about_feature_nation_help_center_text', 'Need assistance? Our team is here for you 24/7 with order support, product questions, and fast resolutions.'),
'about_feature_nation_secure_checkout'    => setting('about_feature_nation_secure_checkout', 'Secure Checkout'),
            'about_feature_nation_secure_checkout_text'    => setting('about_feature_nation_secure_checkout_text', 'Shop with confidence using secure payments and encrypted checkout. Your information stays protected at every step.'),
'about_feature_nation_return'    => setting('about_feature_nation_return', '30 Days Return'),
'about_feature_nation_return_text'    => setting('about_feature_nation_return_text', 'Changed your mind? Enjoy a hassle-free 30-day return policy. Return eligible items in simple steps and get support quickly.'),
            'about_what_we_offer_heading'              => setting('about_what_we_offer_heading', 'What We Offer'),
            'about_what_we_offer_body'                 => setting('about_what_we_offer_body', 'We offer a wide range of quality products that blend modern trends with classic elegance. Each piece is carefully curated to ensure it meets our standards of quality, durability, and style.'),
            'about_feature_nation_wide_delivery'       => setting('about_feature_nation_wide_delivery', 'Nationwide Delivery'),
            'about_feature_nation_wide_delivery_text'  => setting('about_feature_nation_wide_delivery_text', 'Fast and reliable delivery to your doorstep. Track your order and enjoy safe, secure packaging for every purchase.'),
            'about_feature_nation_help_center'         => setting('about_feature_nation_help_center', '24/7 Help Center'),
            'about_feature_nation_help_center_text'    => setting('about_feature_nation_help_center_text', 'Need assistance? Our team is here for you 24/7 with order support, product questions, and fast resolutions.'),
            'about_feature_nation_secure_checkout'     => setting('about_feature_nation_secure_checkout', 'Secure Checkout'),
            'about_feature_nation_secure_checkout_text'=> setting('about_feature_nation_secure_checkout_text', 'Shop with confidence using secure payments and encrypted checkout. Your information stays protected at every step.'),
            'about_feature_nation_return'              => setting('about_feature_nation_return', '30 Days Return'),
            'about_feature_nation_return_text'         => setting('about_feature_nation_return_text', 'Changed your mind? Enjoy a hassle-free 30-day return policy. Return eligible items in simple steps and get support quickly.'),
            'about_img_1'           => setting('about_img_1', ''),
            'about_img_2'           => setting('about_img_2', ''),
            'about_img_3'           => setting('about_img_3', ''),
        ];

        return view('admin.pages.about', compact('data'));
    }

    public function updateAbout(Request $request): RedirectResponse
    {
        $request->validate([
            'about_story_heading'     => 'required|string|max:255',
            'about_story_sub_heading'     => 'required|string|max:255',
            'about_story_body'        => 'nullable|string|max:5000',
            'about_stat_1_number'     => 'nullable|string|max:50',
            'about_stat_1_label'      => 'nullable|string|max:100',
            'about_stat_2_number'     => 'nullable|string|max:50',
            'about_stat_2_label'      => 'nullable|string|max:100',
            'about_stat_3_number'     => 'nullable|string|max:50',
            'about_stat_3_label'      => 'nullable|string|max:100',
            'about_stat_4_number'     => 'nullable|string|max:50',
            'about_stat_4_label'      => 'nullable|string|max:100',
            
            'about_what_we_offer_heading'               => 'nullable|string|max:255',
            'about_what_we_offer_body'                  => 'nullable|string|max:2000',
            'about_feature_nation_wide_delivery'        => 'nullable|string|max:255',
            'about_feature_nation_wide_delivery_text'   => 'nullable|string|max:1000',
            'about_feature_nation_help_center'          => 'nullable|string|max:255',
            'about_feature_nation_help_center_text'     => 'nullable|string|max:1000',
            'about_feature_nation_secure_checkout'      => 'nullable|string|max:255',
            'about_feature_nation_secure_checkout_text' => 'nullable|string|max:1000',
            'about_feature_nation_return'               => 'nullable|string|max:255',
            'about_feature_nation_return_text'          => 'nullable|string|max:1000',
            'about_img_1'             => 'nullable|image|max:2048',
            'about_img_2'             => 'nullable|image|max:2048',
            'about_img_3'             => 'nullable|image|max:2048',
        ]);

        $this->settings->setMultiple([
            'about_story_heading'                       => $request->about_story_heading,
            'about_story_sub_heading'                   => $request->about_story_sub_heading,
            'about_story_body'                          => $request->about_story_body ?? '',
            'about_stat_1_number'                       => $request->about_stat_1_number ?? '',
            'about_stat_1_label'                        => $request->about_stat_1_label ?? '',
            'about_stat_2_number'                       => $request->about_stat_2_number ?? '',
            'about_stat_2_label'                        => $request->about_stat_2_label ?? '',
            'about_stat_3_number'                       => $request->about_stat_3_number ?? '',
            'about_stat_3_label'                        => $request->about_stat_3_label ?? '',
            'about_stat_4_number'                       => $request->about_stat_4_number ?? '',
            'about_stat_4_label'                        => $request->about_stat_4_label ?? '',
            'about_what_we_offer_heading'               => $request->about_what_we_offer_heading ?? '',
            'about_what_we_offer_body'                  => $request->about_what_we_offer_body ?? '',
            'about_feature_nation_wide_delivery'        => $request->about_feature_nation_wide_delivery ?? '',
            'about_feature_nation_wide_delivery_text'   => $request->about_feature_nation_wide_delivery_text ?? '',
            'about_feature_nation_help_center'          => $request->about_feature_nation_help_center ?? '',
            'about_feature_nation_help_center_text'     => $request->about_feature_nation_help_center_text ?? '',
            'about_feature_nation_secure_checkout'      => $request->about_feature_nation_secure_checkout ?? '',
            'about_feature_nation_secure_checkout_text' => $request->about_feature_nation_secure_checkout_text ?? '',
            'about_feature_nation_return'               => $request->about_feature_nation_return ?? '',
            'about_feature_nation_return_text'          => $request->about_feature_nation_return_text ?? '',
        ]);

        foreach ([1, 2, 3] as $i) {
            if ($request->hasFile("about_img_{$i}")) {
                $path = $request->file("about_img_{$i}")->store("pages/about", 'public');
                $this->settings->set("about_img_{$i}", $path);
            }
        }

        $this->settings->clearCache();

        return redirect()->back()->with('success', 'About page updated successfully.');
    }

    public function editContact(): View
    {
        $data = [
            'site_address'           => setting('site_address', ''),
            'site_phone_1'           => setting('site_phone_1', ''),
            'site_phone_2'           => setting('site_phone_2', ''),
            'site_email_1'           => setting('site_email_1', ''),
            'site_email_2'           => setting('site_email_2', ''),
            'site_facebook'          => setting('site_facebook', ''),
            'site_instagram'         => setting('site_instagram', ''),
            'site_linkedin'          => setting('site_linkedin', ''),
            'site_twitter'           => setting('site_twitter', ''),
            'contact_store_name'     => setting('contact_store_name', ''),
            'contact_store_hours'    => setting('contact_store_hours', 'Mon–Sat, 10 AM – 6 PM'),
            'contact_hero_heading'   => setting('contact_hero_heading', 'Contact us'),
            'contact_form_heading'   => setting('contact_form_heading', 'Do you have any question?'),
            'contact_form_subtext'   => setting('contact_form_subtext', 'Fill out the form and our team will get back to you within 24 hours.'),
        ];

        return view('admin.pages.contact', compact('data'));
    }

    public function updateContact(Request $request): RedirectResponse
    {
        $request->validate([
            'site_address'            => 'nullable|string|max:500',
            'site_phone_1'            => 'nullable|string|max:50',
            'site_phone_2'            => 'nullable|string|max:50',
            'site_email_1'            => 'nullable|email|max:255',
            'site_email_2'            => 'nullable|email|max:255',
            'site_facebook'           => 'nullable|url|max:255',
            'site_instagram'          => 'nullable|url|max:255',
            'site_linkedin'           => 'nullable|url|max:255',
            'site_twitter'            => 'nullable|url|max:255',
            'contact_store_name'      => 'nullable|string|max:255',
            'contact_store_hours'     => 'nullable|string|max:255',
            'contact_hero_heading'    => 'required|string|max:255',
            'contact_form_heading'    => 'nullable|string|max:255',
            'contact_form_subtext'    => 'nullable|string|max:1000',
        ]);

        $this->settings->setMultiple([
            'site_address'            => $request->site_address ?? '',
            'site_phone_1'            => $request->site_phone_1 ?? '',
            'site_phone_2'            => $request->site_phone_2 ?? '',
            'site_email_1'            => $request->site_email_1 ?? '',
            'site_email_2'            => $request->site_email_2 ?? '',
            'site_facebook'           => $request->site_facebook ?? '',
            'site_instagram'          => $request->site_instagram ?? '',
            'site_linkedin'           => $request->site_linkedin ?? '',
            'site_twitter'            => $request->site_twitter ?? '',
            'contact_store_name'      => $request->contact_store_name ?? '',
            'contact_store_hours'     => $request->contact_store_hours ?? '',
            'contact_hero_heading'    => $request->contact_hero_heading,
            'contact_form_heading'    => $request->contact_form_heading ?? '',
            'contact_form_subtext'    => $request->contact_form_subtext ?? '',
        ]);

        $this->settings->clearCache();

        return redirect()->back()->with('success', 'Contact page updated successfully.');
    }
}
