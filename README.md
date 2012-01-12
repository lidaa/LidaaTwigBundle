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

	**PhpExtension** (see documentation : /Resources/doc/php)

	**ImageExtension** (see documentation : /Resources/doc/image)

	**UrlExtension** (see documentation : /Resources/doc/url)

	**CssExtension** (see documentation : /Resources/doc/css)

	**JsExtension** (see documentation : /Resources/doc/js)

	**TagExtension** (see documentation : /Resources/doc/tag)

	**SessionExtension** (see documentation : /Resources/doc/session)

	**NumberExtension** (see documentation : /Resources/doc/number)

	**SfExtension** (see documentation : /Resources/doc/sf)

TODO:
============
- FormExtension
- Tests







