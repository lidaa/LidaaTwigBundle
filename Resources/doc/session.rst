
::

  session_start()

Starts the session storage.


::

  session_has($name)

Checks if an attribute is defined.

::

  session_get($name, $default = null)

Returns an attribute.

::

  session_all()

Returns attributes.

::

  session_locale()

Returns the locale

::

  session_id()

Returns the session ID

::

  session_flash($name, $default = null)

Gets a flash message.


::

  session_regenerate($destroy = false)

Migrates the current session to a new session id while maintaining all session attributes ($destroy = false).


**Example:**

::

  {{ session_start() }}
  
  {{ session_has('attributename') }}
  
  {{ session_get('attributename', 'defaultvalue') }}
  
  {{ session_all() }}
  
  {{ session_locale() }}
  
  {{ session_id() }}
  
  {{ session_flash('flashname', 'defaultvalue') }}
  
  {{ session_regenerate(false) }}
