<?php

function format_large_number($number) {
    if ($number >= 1000000000) {
        return number_format($number / 1000000000, 1) . 'M+';
    }
    if ($number >= 1000000) {
        return number_format($number / 1000000, 1) . 'Jt+';
    }
    if ($number >= 1000) {
        return number_format($number / 1000, 1) . 'K+';
    }
    return $number;
}

function mask_email($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        list($user, $domain) = explode('@', $email);
        $user_len = strlen($user);
        $masked_user = substr($user, 0, 2) . str_repeat('*', $user_len - 4) . substr($user, -2);
        return $masked_user . '@' . $domain;
    }
    return $email;
}
