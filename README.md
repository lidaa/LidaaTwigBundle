Provides a lot of Twig Extensions.

Installation
============

**1- Add the following lines in your deps file:**

	[LidaaTwigBundle]
		 git=git://github.com/lidaa/LidaaTwigBundle.git
		 target=/bundles/Lidaa/TwigBundle


**2- Now, run the vendors script to download the bundle:**

	$ php bin/vendors install

**3- Add LidaaTwigBundle to your application kernel:**

	// app/AppKernel.php
	public function registerBundles()
	{
		 return array(
		     // ...
		     new Lidaa\TwigBundle\LidaaTwigBundle(),
		     // ...
		 );
	}

**4- Add the 'Lidaa' namespace to your autoloader:**

	// app/autoload.php
	$loader->registerNamespaces(array(
		 //...
		 'Lidaa' => __DIR__.'/../vendor/bundles',
		 //...
	));

Extensions:
============

**PhpExtension** (see documentation)
**ImageExtension** (see documentation)
**UrlExtension** (see documentation)
**CssExtension** (see documentation)
**JsExtension** (see documentation)
**TagExtension** (see documentation)

TODO:
============
- SessionExtension
- NumberExtension
- AjaxExtension
- Sf2Extension
- FormExtension
- Tests







