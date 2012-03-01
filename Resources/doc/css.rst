
::

 css_tag($path, $options)

Generate the tag "link" with options passed as parameters, attribute 'type'='text/css' if isn't specified

**Example:**

::

 {{ css_tag('bundles/acmedemo/css/demo.css', {'rel':'stylesheet', 'media':'all'}) }} 

=>

::

 <link type="text/css" media="all" rel="stylesheet" href="/sf209/web/bundles/acmedemo/css/demo.css" />
