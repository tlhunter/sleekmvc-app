<?php
class Config {
    private static $configuration = null;

    public static function load($config) {
        $config = parse_ini_file(APP_DIR . "/{$config}.ini", TRUE);
        if (!$config) {
            return FALSE;
        }

        $config_global = $config['global'];
        $config_local = $config[$config['server'][$_SERVER['HTTP_HOST']]];

        if (!$config_local) {
            return FALSE;
        }

        self::$configuration = array_merge($config_local, $config_global);
        return TRUE;
    }

    public static function get($key) {
        if (isset(self::$configuration[$key])) {
            return self::$configuration[$key];
        }
        return NULL;
    }
}
