<?php

if (!function_exists('app')) {
    function app() {
        return new class {
            public function version() {
                return '5.3';
            }
        };
    }
}