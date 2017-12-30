=== Cryptocurrency ===
Contributors: matstars, statenweb
Donate link: https://statenweb.com/donate
Tags: cryptocurrency, bitcoin, litecoin, ethereum, bitcoin cash, ripple
Requires at least: 4.0
Tested up to: 4.9.1
Stable tag: 0.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Calculate and output your cryptocurrency portfolio's performance

== Description ==

Adds an admin screen to enter in your cryptocurrency purchases and then exposes a simple to use shortcode and simple API to output your cryptocurrency portfolio's performance on the frontend.

## Simple usage:

### Adding your portfolio


- Download, install and activate the plugin.
- Go to `Settings` > `Cryptocurrency`
- Populate your coin purchases and your cost bases. You can enter multiple entries for the same currency (i.e. you have bought the same currency multiple times at different cost bases).
- ???
- Profit!... or look and see how to output the table on the frontend.


### Outputting the data



#### Shortcode

```
[cryptocurrency_table]
```

#### PHP API

```
cryptocurrency_table();
```

#### Filters

For the sake of brevity, by default, the table does not output (1) the current price of each currency and (2) the last time the price was retrieved (see API section below), which can be enabled by adding the following:

Showing the current price:
```
add_filter( 'cryptocurrency/show_current_price', __return_true' );
```

Showing the last updated:
```
add_filter( 'cryptocurrency/show_last_updated', __return_true' );
```

#### API

This plugin uses the public API made available by coinmarketcap.com. It is built to cache responses for 60 seconds so as to not flood the API. The plugin injects the last updated date/time as part of the response object which can be exposed via a filter (see Filters above). Please make sure to follow their API rules. See https://coinmarketcap.com/api/ for more information.


#### Release Notes

- 0.0.2
adding translation template

- 0.0.1
initial release

#### Roadmap
Things I'd like to add in the future
- Ability to set and display data based on a specific currency (currently only supports USD).

- Translations, feel free to translate this into your own language, `cryptocurrency` is the text domain.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)

