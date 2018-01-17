## Adminhtml
Allows admin to manage all the attributes etc from the admin section.

> All Admin controllers extend the Magento\Backend\App\Action class which in turn extends the Magento\Backend\App\AbstractAction.  In order to provide backend-specific functionality.  Such as secret key processing and ACL mechanism.

###### Grids
* UiComponent that represents a list of records for a specific entity.
* Provide an ability to sort, filter, and search through a list of records.
* Allow execution of certain events on a group of records.

* Grid included into page using layout.xml. UiComponent

Grid components
* Listing
* Columns: Column
* Filters: Select, Input, Range, Search, Date
* Paging: Pagination...
* Mass actions: renders mass actions dropdown menu

```xml
<!-- UiComponent Class -->
<listing sorting="true" class="Magento\Ui\Component\Listing">
  <argument name="data" xsi:type="array">
    <!-- Root template -->
    <item name="template" xsi:type="string">templates/listing/default</item>
    ...
  </argument>
</listing>
```
###### Filters
> Simplify searching through a list of records. etc...   

> How filters are applied depends upon the data providers implementation.  The native data provider /Magento/Framework/View/Element/UiComponent/DataProvider/DataProvider uses a FilterPool object /Magento/Framework/View/Element/UiComponent/DataProvider/FilterPool which contains an applyFilters() method that does just that, applies filters.  The configuration for this method and other filters can be defined in di.xml for a specific grid.

###### DataSource
* Does not contain actual data.
* Works with ```DataProvider``` class to obtain data.
* ```DataSource``` and ```DataProvider``` are usually re-declared on each specific grid.
* ```DataSource``` is a Javascript module so it uses ```DataProvider```, which is a PHP class, to generate data for ```DataSource```.
* Configuration for ```DataSource``` component goes in ```definition.xml``` file.
* ```AbstractDataProvider``` is a class that every ```DataProvider``` has to extend. Its key method ```getData``` has to be implemented.  ```getData``` returns data from a collection.  ```DataProvider``` classes only wrap collection classes which extract data from the database.


###### Grids Part 2
* Columns UiComponent acts as a container for sets of columns.
* Each column is represented by its own UiComponent.
* Columns are defined in the ```definition.xml```
* Columns ```Magent\Ui\Component\Listing\Columns```, ```Magent\Ui\Component\Listing\Columns\Column```
* ```columns.js``` renders columns in Javascript.
* Dynamic columns Javascript rendering provides.

###### Mass Actions
* List actions configured in ```data/config/actions``` argument.
* Defined in ```definition.xml```

###### Paging
* Configured in ```definition.xml```


#### Adminhtml Forms
* Almost all backend interfaces built from forms and grids.
* Magento Form UiComponent PHP class is: ```Magento/Ui/Component/Form```
* Configured in ```definition.xml```
* Fieldset component  ```Magento\Ui\Component\Form\Fieldset``` extends ```AbstractComponent```

###### System Configuration
> Stored in database with different scopes, global, website, store.

* M2 configuration page provides configuration options for the merchant where technical aspects are left out.  Configuration options are stored in a database unlike the xml configurations.  The corresponding table is core_config_data.
* Configuration options can be scoped on global, website, or store.  All options are previously declared in a special configuration file ```system.xml```.
* Option names consists of 3 parts: section, group, and field id.
* List of all available ```<field>``` node children.  The list is located at ```Magento/Config/etc/system_file.xsd```.
* frontend model implementation extends ```Magento/Config/Block/System/Config/Form``` which itself extends ``` Magento/Backend/Block/Template```.
* Menu config file is setup in ```menu.xml```.  Add new items using ```<add>``` directive with name (id attribute), module it belongs to, a visible title, and an ACL (resource attribute).

####### ACL
* Defined in ```acl.xml```.

```php
// Magento\Backend\App\AbstractAction
<?php
protected function _isAllowed()
{
  return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
}
```

```php
// Implementation Example
// Magento\Catalog\Controller\Adminhtml\Product
<?php
protected function _isAllowed()
{
  return $this->_authorization->isAllowed('Magento_Catalog::products');
}
```
