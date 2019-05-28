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
 * Create a routes.xml, Create correct action class and implement `execute()` method.
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
* Extends AbstractBlock  
* Block Types: Text, ListText, Messages, Redirect, Template
* Block creates a link between layouts and templates.  Blocks are defined using `<block>` element in `layout.xml` file.
* One block can contain multiple templates. Block can be used in multiple pages or other blocks.
* Block Flow: `_prepareLayout()` -> `toHtml()` -> `_beforeToHtml()` -> `_toHtml()` -> `_afterToHtml()`
  * recommended to not overwrite `toHtmlt()`, but instead the other `_toHtml()` methods, where specific rendering logic resides.
* Rendering Flow: `Layout::getOutput()` loops for all "output" blocks in  Containers `empty.xml` which calls `Block::toHtml()` for each block.  The block calls each of it's templates (`.phtml`) and those children, childrens children etc.

#### URL Processing
* http://magento.com/catalog/product/view/id/1
  * Front Name: `catalog` (Module Name 'Catalog')
  * Controller Name: `product` (ActionPath, 'Catalog/Product')
  * Action Name: `view` (Action Class, 'View.php')
  * Parameters: `id=1`

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
1. Adding vault enabling controls.
2. Modifying the payment component (updating of the additional_data property must be added).
3. Creating a request data builder.  
4. [Vault](https://devdocs.magento.com/guides/v2.3/payments-integrations/vault/enabler.html)

#### Adding new field for customer address  
[Add new field to customer address](https://devdocs.magento.com/guides/v2.3/howdoi/checkout/checkout_new_field.html)


#### How to add manufacturer image on each product in checkout cart  


#### Replace image in the item on configurable product on checkout cart  


#### Adding attribute by setup  


#### Final price in product view, what calculations.


#### Magento Setting, Total Amount Order Display  
`vendor/magento/module-store/etc/config.xml` under `<config><default><sales><totals_sort>`  
`System->Configuration->Sales->Checkout Total Sort Order`

#### In which XML file are the default store configuration are set  
`vendor/magento/module-store/etc/config.xml`

#### How to use repositories to filter results  
For filtering results for a say, a product.  We need a new class which has `ProductRepositoryInterface` and `SearchCriteriaBuilder` classes passed in via DI.  You can set a filter such as this:
```php
<?php
namespace Vendor\ModlueName\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Api\ProductRepositoryInterface;

class ProductFilterDemo
{
    /** @var ProductRepositoryInterface */
    protected $productRepository;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /**
     * Initialize dependencies.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Get products with filter.
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @param string $filterType
     * @return \Magento\Catalog\Api\Data\ProductInterface[]
     */
    public function getProducts($fieldName, $fieldValue, $filterType)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter($fieldName, $fieldValue, $filterType)->create();
        $products = $this->productRepository->getList($searchCriteria);
        return $products->getItems();
    }
}
```

Ex:
```php
<?php
// Check out the following sample class. To filter by SKU, try this:

$productFilterDemo->getProducts('sku', 'product_sku_value', 'eq');
// To get products created after specific date, this:

$productFilterDemo->getProducts('created_at', 'creation date', 'gt');
```

#### Which options would you use for adding new attributes to be included in flat table  


#### Client would like to have custom URL for sorting (/dress-sort-by-name-filter-by-sale)  
* Need to convert the non-standard URL to a standard Magento URL by parsing it and setting it in `$request`  
* ``$request->setModuleName('')->setControllerName('')->setActionName('')->setParam('','');``

#### How would you capture HTML for specific action  


#### Which steps are required to add new online payment methods  


#### Plugins Lifecycle  


#### Would a single not cacheable block would disable page cache for given page  


#### Widgets XML and dataSources  


#### Standard product types (simple, configurable, bundled, etc.).  


#### Customize actions of adding products to cart  


#### Model
* Must know what resource model to use.  Passed in the `_init()` function in the `_construct()`
* Notice these are protected function and not PHP magic methods because they have one underscore.  
* Each Model must have a ResourceModel, and ResourceCollection.
* Models encapsulate storage independent business logic.  Models don't know about storage persistence.
* Resource Models encapsulate the storage layer logic.  All storage actions are responsibility of ResourceModel.
* Resource Collections represent list of models of a specific type. Used for working with multiple records.

```php
<?php
class Block extends \Magento\Framework\Model\AbstractModel implements BlockInterface, IdenttiyInterface
{
  // Passes Resource Model through Model class.
  protected function _construct() {
    $this->_init(\Magento\Cms\Model\ResourceModel\Block::class);
  }
}

abstract class AbstractModel extends \Magento\Framework\Object
{
  protected function _init($resourceModel) {
    $this->_setResourceModel($resourceModel);
    $this->_idFieldName = $this->_getResource()->getIdFieldName();
  }
}
```

#### Resource Model
* extends `\Magento\Framework\Model\Resource\DB\AbstractDb`
* define table man and primary key attribute.

```php
<?php
class Block extends \Magento\Framework\Model\resource\DB\AbstractDb
{
  // Sets _idFiledName and _mainTable
  protected function _construct() {
    $this->_init('cms_block', 'block_id');
  }
}

abstract class AbstractDb extends \Magento\Framework\Model\Resource\AbstractResource
{
  protected function _init($mainTable, $idFieldName) {
    $this->_setMainTable($mainTable, $idFieldName);
  }
  protected function _setMainTable($mainTable, $idFieldName = null) {
    $this->_mainTable = $mainTable;
    if(null === $idFieldName) {
      $idFiledName = $mainTable . '_id';
    }
    $this->_idFieldName = $idFieldName;
    return $this;
  }
}
```

#### Collection to Model
* Needs to know Model and Resourcemodel  

```php
<?php
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
  protected function _construct()
  {
    $this->_init(
      \Magento\Cms\Model\Block::Class,
      \Magento\Cms\Model\ResourceModel\Block::Class
    );
    $this->_map['fields']['store'] = 'store_table.store.id';
    $this->_map['fields']['block_id'] = 'main_table.block_id';
  }
}
```

#### Describe how to filter, sort, and specify the selected values for collections and repositories.


#### EAV (Entity Attribute Value)
