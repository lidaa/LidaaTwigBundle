::

    html_crumbs($classBuilder, $parameters)

Generates a breadcrumb trail

::

    html_doctype($type = 'html5')

Returns a doctype string.

    Possible doctypes:
    
    - html4-strict: HTML4 Strict.
    - html4-trans: HTML4 Transitional.
    - html4-frame: HTML4 Frameset.
    - html5: HTML5.
    - xhtml-strict: XHTML1 Strict.
    - xhtml-trans: XHTML1 Transitional.
    - xhtml-frame: XHTML1 Frameset.
    - xhtml11: XHTML1.1.

::

    html_charset($charset = 'utf-8')

Returns a charset META-tag.

$charset : The character set to be used in the meta tag. If empty, "utf-8" will be used.

::

    html_br($nbr = 1)

Generates the tag '<br />' based on the number you submit.

::

    html_nbsp($nbr = 1)

Generates the code of space (&nbsp;) based on the number you submit.

::

    html_meta($name, $content, $options = array())

Generates meta tags.

::

    html_refresh($delay, $url = '')

Generates meta refresh tag.

::

    html_object($uri, $meme_type, $attributes = array(), $params = array(), $content = null)

Generates markup for embedding a custom Object.


**Examples:**

- Create a Builder class
first create a new class in the "Crumbs" directory of one of your bundles. This class - called Builder in our example - will have one method for each breadcrumbs that you need to build.

An example builder class would look like this:

::

    // src/Acme/DemoBundle/Crumbs/mainBuilder.php
    namespace Acme\DemoBundle\Crumbs;
    
    use Lidaa\TwigBundle\Crumbs\Crumbs;
    
    class mainBuilder 
    {
        
        public function crumb(Crumbs $crumbs, $variables) {
            
            $crumbs->setSeparator('*');
    
            $crumbs
                ->addItem('_welcome', '_welcome')
                ->addItem('_demo', '_demo')
                ->addItem('_this', $variables['request']->getRequestUri(), array('route' => false));
            
           
            return $crumbs;
        }
        
    }

- Render the BreadCrumb by :

::

    {{ html_crumbs('AcmeDemoBundle:mainBuilder:crumb', {'request': app.request}) }}

With this method, you refer to the breadcrumb using a three-part string: bundle:class:method.
You can pass all parameters to use in the method of the Builder in the second argument, e.g : **app.request**.

=> 

::

    <ul class="crumbs">
    <li><a href="/symfony/web/app_dev.php/">Acceuil</a></li>*
    <li><a href="/symfony/web/app_dev.php/demo/">_demo</a></li>*
    <li><a href="/symfony/web/app_dev.php/">_this</a></li>
    </ul>

----------------------------------

::

    {{  html_doctype('html5') }} OR {{  html_doctype() }}

=> 

::

    <!DOCTYPE html>

----------------------------------

::

    {{  html_charset('utf-8') }} OR {{  html_charset() }} 

=> 

::

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

----------------------------------

::

    {{  html_br(5) }}

=> 

::

    <br /><br /><br /><br /><br />

----------------------------------

::

    {{  html_nbsp(3) }}

=> 

::

    &nbsp;&nbsp;&nbsp;

----------------------------------

::

    {{  html_meta('description', 'Une description de la page...') }}

=> 

::

    <meta content="Une description de la page..." name="description">

----------------------------------

::

    {{  html_refresh(4) }}

=> 

::

    refresh the page in 4 seconds

----------------------------------

::

    {{  html_object('/path/to/file.ext', 'mime/type', {'attr1': 'aval1', 'attr2': 'aval2'}, {'param1': 'pval1', 'param2': 'pval2'}, 'some content') }}

=> 

::

    <object data="/path/to/file.ext" type="mime/type" attr1="aval1" attr2="aval2">
        <param name="param1" value="pval1" />
        <param name="param2" value="pval2" />
        some content
    </object>

