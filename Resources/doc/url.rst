

// Generates a link to a URL passed in parameter $route_name with parameters

link_to($title, $route_name, $route_parameters, $options)


// Generates a link if $condition is true

link_to_if($condition, $title, $options)


// Generates a link if $condition is false

link_to_unless($condition, $title, $options)


Example:
=======


{{ link_to('title', '_welcome', {'id':22}, {'class':'demo'}) }}

in routing file:

_welcome:
    pattern:  /id/{id}
    defaults: { _controller: ... }

=>

<a href='/symfony/web/app_dev.php/id/22' class='demo'>title</a>


{{ link_to_if(true, 'title', {'class':'demo', 'href':'#'}) }}

=>

<a href='#' class='demo'>title</a>
