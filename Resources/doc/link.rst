::

    link_to($title, $route_name, $route_parameters, $options)

Generates a link to a URL passed in parameter $route_name with parameters

::

    link_to_if($condition, $title, $options)

Generates a link if $condition is true

::

    link_to_unless($condition, $title, $options)

Generates a link if $condition is false


::

    mail_to($email, $title = '', $options = array())

Generates  mailto Link


**Example:**

::

    {{ link_to('title', '_welcome', {'id':22}, {'class':'demo'}) }}
    
in routing file:

::

    _welcome:
        pattern:  /id/{id}
        defaults: { _controller: ... }
    
    =>
    
    <a href='/symfony/web/app_dev.php/id/22' class='demo'>title</a>

---------------------------

::

    {{ link_to_if(true, 'title', {'class':'demo', 'href':'#'}) }}
    
    =>
    
    <a href='#' class='demo'>title</a>

---------------------------

::

    {{ link_to_if(is_granted('ROLE_ADMIN'), 'delete', {'class':'demo', 'href':'#'}) }}
    
    => (if is ADMIN)
    
    <a href='#' class='demo'>delete</a>

---------------------------

::

        {{ mail_to('aa_dil@hotmail.fr', 'Contact Me', {'class': 'mail'}) }}

        =>

        <a class="mail" href="mailto:aa_dil@hotmail.fr">Contact Me</a>
