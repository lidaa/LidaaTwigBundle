

// Starts the session storage.

session_start()


// Checks if an attribute is defined.

session_has($name)


// Returns an attribute.

session_get($name, $default = null)


// Returns attributes.

session_all()


// Returns the locale

session_locale()


// Returns the session ID

session_id()


// Gets a flash message.

session_flash($name, $default = null)


// Migrates the current session to a new session id while maintaining all session attributes ($destroy = false).

session_regenerate($destroy = false)


Example:
=======


{{ session_start() }}

{{ session_has('attributename') }}

{{ session_get('attributename', 'defaultvalue') }}

{{ session_all() }}

{{ session_locale() }}

{{ session_id() }}

{{ session_flash('flashname', 'defaultvalue') }}

{{ session_regenerate(false) }}
