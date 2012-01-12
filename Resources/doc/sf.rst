
// Returns the controller name.
controller_name()

// Returns the action name.
action_name()

// Returns the environment ('dev', 'prod', ...).
get_env()

Example:
=======

{{ controller_name() }}  => DefaultController

{{ action_name() }}  => indexAction

{{ get_env() }}  => dev

