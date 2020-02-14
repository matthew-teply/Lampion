<?php

namespace Lampion\Core;

class Session
{
    public static function set(string $name, $value) {
        $_SESSION[$name] = $value;
    }

    public static function unset($name) {
        unset($_SESSION[$name]);
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public function destroy() {
        session_destroy();
    }

    public static function id() {
        return session_id();
    }
}