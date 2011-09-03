<?php
class Config {
    /**
     * The collection of all configuration values for this server
     * @var array
     */
    private static $configuration = null;

    /**
     * This loads our configuration file
     * @param string $config The file we want to load configuration from
     * @return bool Whether or not the configuration file was parsed successfully
     */
    public static function load($config) {
        $config = parse_ini_file(APP_DIR . "{$config}.ini", TRUE);
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

    /**
     * This loads a piece of configuration information
     * @param string $key Which configuration key we want to laod
     * @return mixed The value of the configuration key
     */
    public static function get($key) {
        if (isset(self::$configuration[$key])) {
            return self::$configuration[$key];
        }
        return NULL;
    }
}
