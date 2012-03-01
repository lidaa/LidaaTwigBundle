
::

  unset $var

Unset a given variable


::

  unset $var[2]

Unset a given variable

**Example:**

::

  {% set test = "demo" %}
  
  {% unset test %}
  
  
  {% set test = range(0, 6) %}
  
  {% unset test[1] %}
  
  
  {% set test = {'foo': 'Foo', 'too': 'Too'} %}
  
  {% unset test['foo'] %} OR {% unset test.foo %}
