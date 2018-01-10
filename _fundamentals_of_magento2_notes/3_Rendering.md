## Rendering

#### Rendering Overview
* Templates: phthml files that contain HTML, JS, and PHP.
  * can use any rendering system but phtml is the default.
* Blocks: allow you to move reusable functionality form PHP tempalte files into classes so they can be repurposed for other templates.
* UIComponents: piece of UI that are rendered by JS but still depend on backend to obtain data.
* Design Layout files pull together the entire set of template files to be rendered.

<img src="../images/process_flow.png" width="400px">

#### Rendering Flow
* result object, page object.

<img src="../images/rendering_steps.png" width="400px">

<img src="../images/flow_diagram.png" width="400px">

Result Objects  
<img src="../images/result_objects.png" width="400px">

Page Render  
>  ```appendBody``` will add generated html to the response object.  Variables are obtained in the ```render()``` method and  are echoed in the ```renderPage()``` which includes the root template.

<img src="../images/page_render.png" width="400px">

<img src="../images/public_build_flow.png" width="400px">

#### View Elements
* Containers, Blocks, UIComponents

###### UIComponents
* Standalone UI components that can be represented on the page and rendered using Javascript.

###### Containers
* Container: Doesn't have classes related to it, renders all its children, allows configuration of some attributes.
  * cannot create instances of Containers because they are an abstract concept where as you can with blocks.

###### Blocks
* Layout is determined by containers which act as a framework but do not contain any actual content.
* The content segments are called blocks, examples would be page title, filter navigation.
  * blocks can be viewed as elements of a page.
* blocks are only defined in sequence, the look depends on the layout and CSS.
* Templates draw elements, and blocks contain the data or a method to access the data.
* Before including rootTemplate, in Page::render(), it executes Layout::getOutput() which renders most of the content on the page.

<img src="../images/get_output.png" width="400px">

<img src="../images/layout_xml_struct.png" width="400px">


#### Block Architecture and Life Cycle

###### BlockInterface
```PHP
<?php
phptoHtml()
```

###### AbstractBlock
```php
<?php
/**
* Method that is executed when a block is created, often re-declared with specific block and contains init ops.
*/
_prepareLayout()

/**
 * Since blocks are hierarchical, needs to be methods to add/remove/find/sort children.
 */
addChild()

/**
 * These are methods that are executed right before rendering, also re-declared quite often in blocks.
 * This is the execution flow.  Best to overwrite _toHtml(), where each block type can render it's specific logic, not
 * toHtml().
 */
 toHtml()
_beforeToHtml()
_toHtml()
_afterToHtml()
```
###### Block Types
* Text, ListText, Messages, Redirect, Template
* **Text**: renders Text.
* **ListText**: instance of Text, renders all children.
* **Messages**: Contains list of messages, can have a template, render different types of messages.
* **Redirect**: Template block, renders javascript redirect.
* **Template**: .phtml files, sends to a block.
  * Assigning template files with ```setTemplate()``` use when you have physical access to the block instance.  Constructor argument, in the data array then goes to the ```_construct()``` method.
* Render Template flow: ``` Block::_toHtml() -> Block::fetchView() -> templateEngine::render() -> include $file; ```
* Create & Customize blocks:
  1. **Using layout**: by calling ```$layout->createBlock()```
  2. **Using object manager**: no need for declaration
  3. **Can be customized using DI/plugins**: as with other classes
* **Block Life Cylce**: generating, and rendering.
  * Instances of all blocks based on layout are created.
  * Structure is built and children of blocks are set.
  * ```_prepareLayout()``` method is called on every block.
  * Nothing rendered yet.

  <img src="../images/generating_blocks.png" width="400px">

  <img src="../images/generate_elements.png" width="400px">

  <img src="../images/generator_block.png" width="400px">


* **GeneratorContainer::process()**
  * not a physical class, there is very little, generator container only manages attributes.


* **Rendering**  
<img src="../images/rendering_diagram.png" width="400px">

#### Templates
* Snippets of HTML code (.phtml) that contain PHP elements such as: PHP, Variables, Calls for class methods.
* Located in ```view/_area_/templates``` where \_area_ is frontend/adminhtml etc.
* Fallback: process of defining the full path to a file given only its relative path.
  * ```product/view/details.phtml``` becomes ```Magento_Catalog/view/frontend/templates/product/view/details.phtml```
* ```Block::getTemplateFile()``` is most important step of Fallback flow.
  * Getting fallback takes place in the \_viewFileStystem object which is an instance of Magento\Framework\View.
* **Customizing Templates**
 * 3 Steps to rewriting core template:
  1. Create your module
  2. Create a new template in your module
  3. Set your template to the block that contains the core template to rewrite

#### Layout XML Structure


#### Layout XML Loading and Rendering
