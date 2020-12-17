# WordPress Plugin Update Checker

Library to bootstrap plugin updates for third-party, private repositories if an access token is present. This class requires the [Plugin Update Checker](https://github.com/YahnisElsts/plugin-update-checker) class to be exist. Typically only included in CP Web Pilot to avoid conflict. Use the [Debug Bar](https://wordpress.org/plugins/debug-bar/) plugin to troubleshoot a proper connection.

### Installation

Require this package in your composer.json

```
composer require content-pilot/wp-plugin-update-checker
```

### Usage

Add the following snippets in your main plugin file.

```
use Content_Pilot\Wp_Plugin_Update_Checker\Bootstrap as Update;
```

```
public function __construct() {
    $this->run_update();
}
```

```
private function run_update() {
    $plugin_update = new Update( PLUGIN_NAME );
    $this->loader->add_action( 'plugins_loaded', $plugin_update, 'update_from_cloud', 10 );
}
```

### Changelog

##### 1.1.1
* Define the plugin path for the release asset

##### 1.1.0
* Enable release assets to grab the built version of the repository

##### 1.0.1
* Change plugin_dir_path to accomodate vendor directory nesting
* Add README
* Add CHANGELOG

##### 1.0.0
* Initial commit and release on Packagist