<?php

if (!function_exists('statusColor')) {
    function statusColor(string $status): string
    {
        return match ($status) {
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
}
