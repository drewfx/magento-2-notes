## Database

#### Overview
Object Relational mapping (ORM): technique used to access a relational database from an object oriented language.  

Magento ORM element:
* **Models**: Data + Behavior, entities
* **Resource Models**: Data mappers for storage structure
* **Collections**: Model sets & related functionality such as filtering, sorting, and paging
* **Resources**: such as a database connection via adapters.

Models encapsulate storage independent business logic.  
Resource Models encapsulate storage related logic.  Uses DB adapter. Populates model with data.  

Advantages of this model:
  * Decoupling of the business logic and storage layer.
  * Decoupling of the storage schema from the DB driver implementation (Data Mapper).

<img src="../images/element_relationship.png" width="100%">

Database accessed via:
```
Magento\Framework\Db\Adapter\Pdo

Zend\Db
```

When creating a new model that interfaces with the database, just create the model class and extend it from the Magento frameowrk AbstractModel.
```php
<?php
class Block extends \Magento\Framework\Model\AbstractModel implements BlockInterface, IdentityInterface
{
  protected function _construct()
  {
    $this->_init('Magento\Cms\Model\Resource\Block')
  }
}
```

Resource Model extends ```\Magento\Framework\Model\ResourceModel\Db\AbstractDb```, must define table name and primary key and use ```_construct()``` method not PHPs ```__construct()```.
```php
<?php
class Block extends Magento\Framework\Model\Resource\Db\AbstractDb
{
  protected function _construct()
  {
    $this->_init('cms_block', 'block_id');
  }
}

```

#### Models Detailed Workflow


#### Setup Scripts & Setup Resources


#### EAV Concepts


#### EAV Entity Load & Save


#### Attribute Management
