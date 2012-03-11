Provides a lot of Twig Extensions.

(php, image, url, css, js, tag, session, number, sf, unset, form, html, ...)

Requirement
============

- Twig version 1.5 or later
- Symfony version 2.0.9 or later

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

- PhpExtension (see documentation : [/Resources/doc/php](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/php.rst))

- ImageExtension (see documentation : [/Resources/doc/image](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/image.rst))

- UrlExtension (see documentation : [/Resources/doc/url](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/url.rst))

- CssExtension (see documentation : [/Resources/doc/css](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/css.rst))

- JsExtension (see documentation : [/Resources/doc/js](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/js.rst))

- TagExtension (see documentation : [/Resources/doc/tag](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/tag.rst))

- SessionExtension (see documentation : [/Resources/doc/session](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/session.rst))

- NumberExtension (see documentation : [/Resources/doc/number](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/number.rst))

- SfExtension (see documentation : [/Resources/doc/sf](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/sf.rst))

- UnsetExtension (see documentation : [/Resources/doc/unset](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/unset.rst))

- FormExtension (see documentation : [/Resources/doc/form](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/form.rst))

- HtmlExtension (see documentation : [/Resources/doc/html](https://github.com/lidaa/LidaaTwigBundle/blob/master/Resources/doc/html.rst))


TODO:
============

- Add TextExtension
- Add ajax and highligh to JsExtension






