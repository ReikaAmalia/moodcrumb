<?php

if (! function_exists('format_rupiah')) {
    function format_rupiah(float|int $amount): string
    {
        return 'Rp '.number_format($amount, 0, ',', '.');
    }
}