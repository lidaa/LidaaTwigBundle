

::

  tag_open($name, $options, $close)

Generates an open tag passed in parameter $name (without content).

::

  tag_close($name)

Generates a closing tag passed in parameter $name

::

  tag_content($name, $content, $options)

Generates a tag passed in parameter $name, with a content passed in parameter $content


**Example:**

::

  {{ tag_open('div', {'class':'demo'}, false) }}
  
  => <div class='demo'>

::

  {{ tag_open('div', {'class':'demo'}, true) }}
  
  => <div class='demo' />

::

  {{ tag_close('div') }}
  
  => </div>

::

  {{ tag_content('div', 'content in div tag', {'class':'demo'}) }}
  
  => <div class='demo'>content in div tag</div>
