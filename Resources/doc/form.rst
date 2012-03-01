
::

  type_widget(type, options)

Renders the widget for the given type. 
If type is form, it renders each field in the form, along with a label and error message (if there is one). (see below)

- Options: an optional array through which you can specify a prefix, a suffix or html attributes like class, id, etc ...

::


  type_row(type, options)

Renders the label, any errors, and the HTML form widget for the given field. (e.g. dueDate) inside, by default, a div element.(see below)

- Options: an optional array through which you can specify a prefix, a suffix, the display mode('EWL':Error,Widget,Label), or html tag and its attributes like class, id, etc ...

::

  type_label(type, options)

Renders the label for the given type.(see below)

- Options: an optional array through which you can specify a prefix, a suffix, or html tag and its attributes like class, id, etc ...

::

  type_errors(type, options)

Renders any errors global to the whole form (field-specific errors are displayed next to each field).(see below)

- Options: an optional array through which you can specify a prefix, a suffix, or html tag and its attributes like class, id, etc ...

-------------------------------------------------------

Example 1:
---------

In your controller :
-------------------

::

    public function newAction()
    {

        $form = $this->createFormBuilder()
            ->add('task')
            ->add('dueDate', 'date', array('widget' => 'single_text'))
            ->getForm();
    }


In your twig template :
---------------------- 

::

    <form action="" method="POST">
      {{ type_row(form.task, {'html_row': {'tag': 'div', 'class': 'demo', 'id': 'div_demo', 'display_mode': 'EWL', 'suffix': 'suffix', 'prefix': '<b>prefix</b>'} }) }}
      <input type="submit" />
    </form>


Result:
------


::

    suffix
    <div id="div_demo" class="demo">
        <input type="text" required="required" name="form[task]" id="form_task">
        <label for="form_task">Task</label>
    </div>
    <b>prefix</b>


-------------------------------------------------------

Example 2:
---------

In your controller :
-------------------

::

    public function newAction()
    {
    
        $form = $this->createFormBuilder()
            ->add('task', 'text', array(
                'html_row' => array('display_mode' => 'WE', 'class' => 'class_demo'),
                'html_widget' => array('class' => 'class_demo', 'prefix' => '<span>some help</span>'),
            ))
            ->add('dueDate', 'date', array(
                'widget' => 'single_text',
                'html_label' => array('tag' => 'span', 'prefix' => '<span>*</span>'),
                'html_errors' => array('tag' => 'p'),
                'html_error' => array('tag' => 'label', 'class' => 'class_error'),
            ))
        ->getForm();
    }


In your twig template :
---------------------- 

::

    <form action="" method="POST">
      {{ type_widget(form) }}
      <input type="submit" />
    </form>


Result:
------


::

    <form method="POST" action="">
        <div>
            <input id="form__token" type="hidden" value="2967f0a97722e6f08b82c" name="form[_token]">
    
            <div class="class_demo">
                <input id="form_task" class="class_demo" type="text" required="required" name="form[task]">
                <span>some help</span>
            </div>
    
            <div>
                <label for="form_dueDate">Duedate</label>
                <span>*</span>
                <input id="form_dueDate" type="text" required="required" name="form[dueDate]">
            </div>
    
        </div>
        <input type="submit">
    </form>
