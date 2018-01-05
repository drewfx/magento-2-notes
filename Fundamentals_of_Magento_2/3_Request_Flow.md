## Request Flow

* Definition: **Request Flow** refers to the sequence of steps an app takes to process and response to requests sent to it.

#### High Level Routing Flow Diagram
``` index.php -> Bootstrap -> App -> Routing -> Controllers -> Rendering -> Flushing Output ```

#### Initiation Phase
* Definition: Magento set up key objects to work, those using index.php and bootstrap.

#### Entry Points
* Definition: Magento starts processing a request.
  * ```index.php, pub/cron.php, pub/static.php, shell comamnds ```
