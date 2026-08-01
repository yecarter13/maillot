<?php

use App\Models\SiteSetting;

if (!function_exists('wa_number')) {
    function wa_number(): string
    {
        $number = SiteSetting::getValue('whatsapp_number', '');
        return preg_replace('/[^0-9]/', '', (string) $number);
    }
}

if (!function_exists('wa_link')) {
    function wa_link(string $message = ''): string
    {
        $number = wa_number();
        if (empty($number)) {
            return 'https://wa.me';
        }
        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
    }
}

if (!function_exists('format_fcfa')) {
    function format_fcfa($amount): string
    {
        return number_format((float) $amount, 0, ',', ' ') . ' FCFA';
    }
}
