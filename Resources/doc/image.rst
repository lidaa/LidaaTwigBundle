
::

  img_tag($path, $options)

Generate the tag "img" with options passed as parameters


**Example:**


::

  {{ img_tag('bundles/acmedemo/images/logo.gif', {'title':'Symfony'}) }} 

=>

::

  <img title="Symfony" src="/sf209/web/bundles/acmedemo/images/logo.gif" />