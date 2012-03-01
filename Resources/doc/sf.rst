
::

  controller_name()

Returns the controller name.

::

  action_name()

Returns the action name.

::

  get_env()

Returns the environment ('dev', 'prod', ...).


**Example:**

::

  {{ controller_name() }}  => DefaultController

::

  {{ action_name() }}  => indexAction

::

  {{ get_env() }}  => dev

