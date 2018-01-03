## Magento Outline

###### Links
[6 Goals of Magento](#goalsofmagento)
[]()
[]()
[]()
[]()




* flexible, open source commerce platform
* Zend + MVC

#### 6 Key Goals<a name="goalsofmagento"></a>
* Streamline Customization Process
* Easier Upgrade
* Updated Technology
* Simplify Integrations
* Improved Performance and Scalability
* High Quality Tested Code

#### Modules
* Area
  * Scope of configuration allows Magento to load only required config files.
  * Only dependent config options for that area are loaded
  * Typically have both behavior and view componenets
  * Technically six areas, but work with two, Adminhtml, frontend.

#### Magento Essential Concepts
* Modular code structure
  * not framework files or static theme files
* Themes
  * aesthetics and static assets
  * some can be in module folders as well
* Layout files
  * set of XML files to define what elements can be on a page in blocks
  * block is special PHP class in Magento2 that is connected to a template
  * block class generates piece of html, layout sees what goes on page
* Merged config files
* Object Instantiation "magic"
  * dependency injection
* Naming conventions for controllers and layouts
  * need controller, and register routes in routes.xml
* Events and plugins

#### File architecture
| Component | Location | Comment |
|   ---     |    ---   |   ---   |
| Configuration | /app/etc/ | env.php, modules.php |
| Framework | lib/internal/Magento/Framework | Framework classes |
| Modules | app/code/Magento | Business logic |
| CLI Tools | bin/magento | "php bin/magento list" see commands |
| Themes | app/design | Contains static files that belong to a theme |
| Dev Tools | dev | dev tools |

#### Configuration
* Global config files:
  * app/etc
* Modules
  * modules etc folder
* Theme configuration

#### Magento 2 PHP Classes
* Model/resource   model/collection classes   (moving away from this to API Interface)
* API interfaces
* Controllers
* Blocks
* Observers
* Plugins
* Helpers
* Setup/Upgrade scripts
* UI components
* Other...

#### Enable Custom Code
* create and register a module
* run bin/magento setup:upgrade
* modify core classes with plugin
* create observers
* add class to core's class array constructors
* controllers

#### Modules
* basically a package of code that encapsulates a particular business feature or set of features.
* logical group, minimum dependencies on other modules
* located under /app/code or 3rd party in vendor directory of Magento install.
  * ``` app/code/<vendor>/<module_name>/ ```
  * ``` vendor/<vendor-composer-namespace>/<module_name>/ ```
  * Modules in vendor/ register using Composer autoloader file to call:
    * ``` \Magento\Framework\Module\Registrar::registerModule('<module_name', '__DIR__') ```
* module name should be like Vendor_Module
  * Namespace corresponds to module's vendor
  * Module corresponds to the name assigned to the module by the vendor
* Every module must have an etc/module.xml and registration.php file.
  * registration.php only thing that varies is the name of the module
* all Modules must include name, version, dependencies
* hard dependency means a module cannot function without other modules on which it depends
* soft dependency means a module can function without other modules it depends
* Managing module dependencies
  * name and declare module in module.xml
  * declare dependencies that module has on other modules in composer.json
  * define desired load order of the files in module.xml

#### File System
```
  app/
    |-- etc/            global configuration
    |-- code/           custom modules
    |-- design/         themes
    |-- i18n/           specific translation files
    |-- bootstrap.php   included at beginning of execution
    |-- autoload.php    included at beginning of execution
    |-- functions.php   included at beginning of execution
  bin/      magento2 cli tool
  dev/      useful scripts for developer
  lib/      framework
  vendor/   composer folder with dependencies
  pub/      public on the host with static files
  setup/    installation files
  var/      cache files, logs, generated code
```
###### Module Structure
[Structure Dev Docs](http://devdocs.magento.com/guides/v2.0/extension-dev-guide/build/module-file-structure.html)
```js
  AcmeModule
    |-- Api/
    |-- Block/
    |-- Controller/
    |-- etc/
    |    |-- adminhtml/
    |    |    |-- di.xml
    |    |    |-- events.xml
    |    |    |-- menu.xml
    |    |    |-- routes.xml
    |    |    |-- system.xml
    |    |-- frontend/
    |    |    |-- di.xml
    |    |    |-- events.xml
    |    |    |-- page_types.xml
    |    |    |-- routes.xml
    |    |-- webapi_soap
    |         |-- di.xml
    |-- Helper/
    |-- i18n/
    |-- Model/
    |-- Plugin/
    |-- view/
    |    |-- frontend/
    |    |-- adminhtml/
    |    |-- base/
    |-- composer.json
    |-- LICENSE.txt
    |-- LICENSE_AFL.txt
    |-- README.md
    |-- registration.php
```

#### Modes in Magento 2
* **Developer**
  * static file materialization is not enabled
  * uncaught exceptions displayed in browser
  * exceptions thrown in error handler, not logged
  * highly detailed
* **Production**
  * run when on production
  * exceptions are not displayed to user, goes to log
  * disables static file materialization
  * Magento docroot can have read-only access
* **Default**
  * when no other mode specified
  * hides exceptions from user and writes to logs
  * static file materialization is enabled
  * not recommended, static files materialization slows down. no caching.
* **Maintenance**
  * make site unavailable to the public during updates
  * create ```var/.maintenance.flag``` to enable
* main difference:
  * static view files get served.  css,js,html
  * things that must be processed before given to browser
* set mode in the ```.htaccess``` file by setting ```SetEnv MAGE_MODE=<mode>```

| | Static File Caching | Exceptions Displayed | Exceptions Logged | Performance Impacted (-) |
| --- | --- | --- | --- | --- |
| Developer | | X | | X |
| Production | | | X | |
| Default | X | | X | X | |

#### CLI
