## Service Contracts

#### Service Contracts Overview
* Improve upgrade process
* Formalize customization
* Decouple modules

* Interfaces for modules to declare standard APIs. Service layer used for making customization without dabbling in core.

* Data API provides access to modules entity data.
  * ```_MODULE_NAME/api/data```
* Operational API drives bussines operations supplied by modules.
  * ```_MODULE_NAME/api/```

#### Services API
###### Framework API
* Repositories provide teh equivalent of service-level collections, while the business logic API provides the actual business operations.
* The framework API provides interfaces, implementations, and classes for various parts.

Repositories
  * Provide access to databases through he services API
  * Interface that provides access to a set of objects using the ```getList()``` methods, receives an instance of the ```SearchCriteriaInterface``` as defined as part of the framework.
  * The framework also supplies an implementation for that interface.


#### Data API


#### Web API


#### Quiz (One is wrong)
1. Which of the following is a requirement for a class to implement a data interface: ```It must be a resource model```
2. What object is typically returned by the ```getList()``` method of a repository: ```SearchResult```
3. How can you assign the implementation of an API interface class: ```Use the preference mechanism in di.xml```
4. A typical ```getList()``` method in a repository class will use which object as a parameter: ```SearchCriteria```
5. What class must every repository fixed: ```The is no mandatory class to extend```
