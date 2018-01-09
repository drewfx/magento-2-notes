## Magento Outline

###### Quick View
[6 Goals of Magento](#goalsofmagento)</br>
[Essential Concepts](#essentialconcepts)</br>
[File Architecture](#filearchitecture)</br>
[File Structure](#filestructure)</br>
[Module Structure](#modulestructure)</br>
[Modes](#modes)</br>
[Cli](#cli)</br>
[Cache](#cache)</br>
[Dependency Injection](#DI)</br>
[Object Manager](#OM)</br>
[Plugins](#plugin)</br>




* flexible, open source commerce platform
* Zend + MVC


#### 6 Key Goals<a name="goalsofmagento"></a>
* Streamline Customization Process
* Easier Upgrade
* Updated Technology
* Simplify Integrations
* Improved Performance and Scalability
* High Quality Tested Code


#### Essential Concepts<a name="essentialconcepts"></a>
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

#### File architecture<a name="filearchitecture"></a>

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

#### Modules<a name="modules"></a>
* Area
  * Scope of configuration allows Magento to load only required config files.
  * Only dependent config options for that area are loaded
  * Typically have both behavior and view componenets
  * Technically six areas, but work with two, Adminhtml, frontend
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

#### File System<a name="filestructure"></a>
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
#### Module Structure<a name="modulestructure"></a>
[Structure Dev Docs](http://devdocs.magento.com/guides/v2.0/extension-dev-guide/build/module-file-structure.html)
```
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

#### Modes in Magento <a name="modes"></a>
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
* Other:
  * static view files get served.  css,js,html
  * things that must be processed before given to browser
  * set mode in the ```.htaccess``` file by setting ```SetEnv MAGE_MODE=<mode>```

| | Static File Caching | Exceptions Displayed | Exceptions Logged | Performance Impacted (-) |
| --- | :---: | :---: | :---: | :---: |
| Developer | | X | | X |
| Production | | | X | |
| Default | X | | X | X | |

#### Cli<a name="cli"></a>
* Based on Symfony
  * Install Magento
  * Clear cache
  * Manage indexes
  * Generate non-existent classes
  * Enable/disable available modules
  * Deploy static view files

#### Cache<a name="cache"></a>
* Can clear cache 3 ways
  * From the backend (Admin)
  * Using the CLI bin/magento cache:clean
  * Manually remove cache files

#### Dependency Injection<a name="DI"></a>
* Object dependencies are passed **(injected)** into an object instead of being pulled by the object from the environment.
* A dependency **(coupling)** implies that one component relies on another component to perform a function.
* A large amount of dependency limits code reuse and makes moving components to new projects difficult.
> ``` di.xml <=> list of interfaces, classes, factories =>__construct(...) ```

* Different Classes Instantiation
  1. Singleton-type classes... inserted by DI
  2. Entry classes... created by favorites or respositories
  3. Factories... auto-generated classes.

#### Object Manager<a name="OM"></a>
* A class provided by Magento Framework which is responsible for:
  1. Creating objects
  2. Implementing singleton pattern
  3. Managing dependencies
  4. Automatically instantiating parameters
* It defines:
  1. **Parameters**: Variables declared in the constructor signature.
  2. **Arguments**: Values passed to the constructor when the class instance is created.
* Uses configuration from ```di.xml``` files to define which instances to deliver to the constructor of a class.
* Each module can have multiple ```di.xml``` files (global and specific for an area); all these files are merged.

#### Plugins<a name="plugin"></a>
* Used to extend (change) the behavior of any native method within a Magento class.  Plugins change the *behavior* of the original class, but not the class itself.
  * Cannot use for final methods, final classes, private methods, or classes without DI.

```XML
<!--
You declare a plugin for an object in the
di.xml file for a module.
sortOrder & disabled are optional, best left out.
-->
<config>
    <type name="{ObservedType}">
      <plugin name="{pluginName}"
        type="{PluginClassName}"
        sordOrder="1"
        disabled="true"/>

    </type>
</config>
```

```php
<?php
/**
 * To change arguments of an original method, or add some behavior
 * before the method is called, use before-listener method.
 */
namespace My\Module\Model\Product

class pluginName
{
  public function beforeSetName(\Magento\Catalog\Model\Product $subject, $name)
  {
    return ['('.$name.')'];
  }  
}
```

```php
<?php
/**
 * To change values returned by an original method, or add behavior after an original method,
 * use the after-listener method.
 */
namespace My\Module\Model\Product

class pluginName
{
  public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
  {
    return '|' . $result . '|';
  }  
}
```

```php
<?php
/**
 * To change both arguments and values returned or add behavior before/after the method is called,
 * use the around-listener method.
 *
 * $subject - provides access to all public methods of original class.
 * $proceed - a lambda that will call next plugin or method.
 *
 * Any further arguments will be passed to the around plugin methods after the
 * subject and proceed arguments, they have to passed on to the next plugin.
 */
namespace My\Module\Model\Product

class pluginName
{
  public function aroundSave(\Magento\Catalog\Model\Product $subject, \Closure $proceed)
  {
    $this->doSomethingBeforeProductIsSaved();
    $returnValue = $proceed();
    if ($returnValue) {
      $this->postProductToFacebook();
    }
    return $returnValue;
  }
}
```

#### Configuration Files
* Load config files
  * Primary: Loaded on bootstrap, include config files needed for app start and installation specific configuration.
  * Global: Include config files common across all app areas from all modules.
  * Area-specific: Files that apply to specific areas, such as adminhtml and the frontend.
* Configuration files are validated against a schema specific to its configuration type.
* I.E. ```events.xml``` is validated by ```events.xsd```
* Provide two schemas for validating the configuration files (unless the rules are the same), individual schema, merged schema.
* New configuration files must by accompanied by XSD validation schemas.  An XML configuration file and its XSD validation file must have the same name.
*
