<?php
    defined('DIR') || define('DIR', dirname(__DIR__, 2));
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }