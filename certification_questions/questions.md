#### Layout XML how to set ViewModel into model  
* Offloads features from `Block` classes into separate `ViewModel` classes.  
* Extends `\Magento\Framework\View\Element\Block\ArgumentInterface`
* Add additional `XML` argument to the `Block` class.
* Reason? Simplifies the structure and clutter of your code, instead of extending `\Magento\Framework\View\Element\Template` and having to pass all DI for parent and child in constructor you just pass the DI for the ViewModel now without having to worry about parent.
* Instead of `$block->getSomething()` it's now `$viewModel->getSomething()`

```xml
<block class="Drewsauace\Example\Block\Dummy" name="dummy">
    <arguments>
        <argument name="view_model" xsi:type="object">Drewsauace\Example\ViewModel\Dummy</argument>
    </arguments>
</block>
```
```php
<?php
namespace Drewsauace\Example\ViewModel;

class Dummy implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function __construct()
    {
    }
}
```

#### Create a theme
Namespace: `Drewsauce`  
Theme: `Fresh`  
Path: `$MAGENTO_ROOT/app/design/frontend/Drewsauce/Fresh/`  
ThemeXML Path: `$MAGENTO_ROOT/app/design/frontend/Drewsauce/Fresh/theme.xml`  
Theme XML:
```xml
<theme xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Config/etc/theme.xsd">
     <title>Drewsauce Theme</title> <!-- your theme's name -->
     <parent>Magento/blank</parent> <!-- the parent theme, in case your theme inherits from an existing theme -->
     <media>
         <preview_image>media/preview.jpg</preview_image> <!-- the path to your theme's preview image -->
     </media>
 </theme>
```
RegistrationPath:`$MAGENTO_ROOT/app/design/frontend/Drewsauce/Fresh/registration.php`
```php
<?php
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::THEME,
    'frontend/Cloudways/Mytheme',
    __DIR__
```

#### View: Blocks, Layouts, Templates
1. Create Controller
 * Controllers extend `\Magento\Framework\App\Action\Action` located at `app/code/{namespace}/{module}/Controller/{Index}/{Display.php}`

```php
<?php
namespace Drewsauce\HelloWorld\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

  // Controller must have execute method to process logic
	public function execute()
	{
		return $this->_pageFactory->create();
	}
}
```
2. Create Layout
  * TODO: https://www.mageplaza.com/magento-2-module-development/view-block-layout-template-magento-2.html




#### Relation between block and template (phtml) (ex. One block to multiple templates)  
* Block creates a link between layouts and templates.  Blocks are defined using `<block>` element in `layout.xml` file.
* One block can contain multiple templates. Block can be used in multiple pages or other blocks.
*

#### URL Processing
* http://magento.com/catalog/product/view/id/1
  * Front Name: catalog
  * Controller Name: product
  * Action Name: view
  * Parameters: id=1

#### Front Controllers
* First step in handling requests and workflows in a request.
* Gathers all routers, finds matching controller/router, obtains HTML generated to response object.
* Implements `FrontControllerInterface` and has one method, `dispatch()`

#### Request Flow
* `index.php` -> `Bootstrap::run()` -> `App::launch()` -> `FrontController::dispatch()` -> `Router::match()` -> `Controller::execute()` -> `View::loadLayout()` -> `View::renderLayout()` -> `Response::sendResponse()`
* Action\Action and Controller are used interchangeably.

#### Routing Path
* `FrontController::dispatch()` -> `Base Router` -> `URL Rewrite Router` -> `CMS Router` -> `Default Router` -> `Robot Controller Router`

#### Magento Vault  


#### Adding New field for customer address  


#### Final price in product view, what is affected by it  


#### How to add manufacturer image on each product in checkout cart  


#### Adding attribute by setup  


#### Replace image in the item on configurable product on checkout cart  


#### Magento Setting, Total Amount Order Display  
`vendor/magento/module-store/etc/config.xml` under `<config><default><sales><totals_sort>`  
`System->Configuration->Sales->Checkout Total Sort Order`

#### In which XML file are the default store configuration are set  
`vendor/magento/module-store/etc/config.xml`

#### How to use repositories to filter results  


#### Which options would you used for adding new attributes to be included in flat table  


#### Client would like to have custom URL for sorting (/dress-sort-by-name-filter-by-sale)  
* Need to convert the non-standard URL to a standard Magento URL by parsing it and setting it in `$request`  
* ``$request->setModuleName('')->setControllerName('')->setActionName('')->setParam('','');``

#### How would you capture HTML for specific action  


#### Which steps are required to add new online payment methods  


#### Plugins Lifecycle  


#### Would a single not cacheable block would disable page cache for given page  


#### Widgets XML and dataSources  


#### Describe how to filter, sort, and specify the selected values for collections and repositories  


#### EAV (Entity Attribute Value) mostly  


#### Standard product types (simple, configurable, bundled, etc.).  


#### Customize actions of adding products to cart  
