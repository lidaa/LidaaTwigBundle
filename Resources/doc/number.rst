::

	{{ to_percent($number) }}

Convert a number to a percent.

::

	{{ to_readable_size($number) }}

Convert size in bytes to a human readable format.

::

	{{ number_currency($number, $symbol = 'EUR', $locale = null) }}

Formats a number as a currency string.

::

	number_scientific($number, $locale = null)

print a number in a scientific notation.

::

	localized_number($number, $locale = null)

convert a number to a locale-specific string.

::

	localized_spellout($number, $locale = null)

spell out a number.


**Example:**

::

	{{ to_percent(0.456) }}

=> 

::

	46 % 

--------------------------------------------------------------

::

	{{ to_readable_size(1222) }}

=> 

::

	1.19 KB

--------------------------------------------------------------

::

	{{ number_currency(122, 'EUR') }}

=> 

::

	122,00 €

--------------------------------------------------------------

::

	{{ number_scientific(122) }}

=> 

::

	1,22E2

--------------------------------------------------------------

::

	{{ localized_number(1222.238) }}

=> 

::

	1 222,238

--------------------------------------------------------------

::

	{{ localized_number(1222.238, 'en') }}

=> 

::

	1,222.238 

--------------------------------------------------------------

::

	{{ localized_spellout(12, 'en') }}
	{{ localized_spellout(12, 'fr') }}
	{{ localized_spellout(12, 'ar') }}

=> 

::

	twelve
	douze
	إثنا عشر 

