# Changelog

All notable changes to `laravel-helpers` will be documented in this file


## 0.1.0 - 2020-08-20
- initial release


## 0.2.0 - 2020-09-08
- fix composer requirements to allow for laravel/framework:8.0


## 0.3.0 - 2020-10-07
- add support for Laravel 4 & php5


## 0.3.1 - 2020-11-30
- fix travis ci tests to use stable version of composer


## 0.4.0 - 2020-12-01
- cut support for php5.5 & below


## 0.4.1 - 2020-12-03
- fix issues with Travis CI test matrix


## 0.5.0 - 2021-01-27
- make LaravelHelpers class with static methods 
- add badges to readme 
- cut autoloading of helper functions in composer.json
- add serializeHash method to helper functions


## 0.6.0 - 2021-01-27
- cut support for php5
- add test suite for testing LaravelHelpers functionality
- add orchestra/testbench to dev requirements


## 1.0.0 - 2021-01-27
- fix laravel/framework & phpunit/phpunit min versions
- add improved type hinting
- initial production release


## 1.0.1 - 2021-01-27
- cut support for php7.0


## 1.0.2 - 2021-02-17
- add randomFloat() helper function & static method with test methods


## 1.0.3 - 2021-02-19
- add isBinary() LaravelHelpers method & helper function for checking if a string is a Binary String
- add isSerialized() LaravelHelpers method & helper function for checking if a string is serialized


## 2.0.0 - 2021-03-10
- make AppInfo service for retrieving information about your Laravel Application like the version, most recent changes or environment
- add ServiceProvider with config file for modifying app version & changing the changelog's path
- add sfneal/string-helpers to composer requirements


## 2.0.1 - 2021-03-10
- fix ServiceProvider namespace in composer.json


## 2.0.2 - 2021-03-11
 - optimize return type hinting
 - reformat linebreaks & whitespace
 - fix `cacheKey()` method to use config 'cache_prefix' value & cut CACHE_PREFIX const


## 2.1.0 - 2021-03-11
- refactor `isProductionEnvironment()` helper to `isEnvProduction()` to match AppInfo method
- refactor `isDevelopmentEnvironment()` helper to `isEnvDevelopment()` to match AppInfo method


## 2.1.1 - 2021-03-11
- add `AppInfo::env()` method for quickly retrieving the application environment
- add `AppInfo::isEnvTesting()` method for checking if the application is in a 'testing' environment
