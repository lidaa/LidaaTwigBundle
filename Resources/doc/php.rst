
::

	{{ php_*($parameter) }}

Call a function PHP in Twig template

**Example:**

::

	{{ php_print_r({1:'value1', 2:'value2'}) }}

=> 

::

	Array ( [1] => value1 [2] => value2 )

--------

::

	{{ php_crypt('mypassword') }}

=> 

::

	$1$oc.SL9Zy$HNmCBsIfCsgRtWKpDZhpB.