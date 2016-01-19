# Creating tag clouds with Zend\\Tag\\Cloud

`Zend\Tag\Cloud` is the rendering part of `Zend\Tag`. By default it comes with a set of *HTML*
decorators, which allow you to create tag clouds for a website, but also supplies you with two
abstract classes to create your own decorators, to create tag clouds in *PDF* documents for example.

You can instantiate and configure `Zend\Tag\Cloud` either programmatically or completely via an
array or an instance of `Traversable`. The available options are:

**Using Zend\\Tag\\Cloud**

This example illustrates a basic example of how to create a tag cloud, add multiple tags to it and
finally render it.

```php
// Create the cloud and assign static tags to it
$cloud = new Zend\Tag\Cloud(array(
    'tags' => array(
        array(
            'title'  => 'Code',
            'weight' => 50,
            'params' => array('url' => '/tag/code'),
        ),
        array(
            'title'  => 'Zend Framework',
            'weight' => 1,
            'params' => array('url' => '/tag/zend-framework'),
        ),
        array(
            'title' => 'PHP',
            'weight' => 5,
            'params' => array('url' => '/tag/php'),
        ),
    ),
));

// Render the cloud
echo $cloud;
```

This will output the tag cloud with the three tags, spread with the default font-sizes:

```php
<ul class="zend-tag-cloud">
    <li>
        <a href="/tag/code" style="font-size: 20px;">
            Code
        </a>
    </li>
    <li>
        <a href="/tag/zend-framework" style="font-size: 10px;">
            Zend Framework
        </a>
    </li>
    <li>
        <a href="/tag/php" style="font-size: 11px;">
            PHP
        </a>
    </li>
</ul>
```

> ## Note
The HTML code examples are preformatted for a better visualization in the documentation.
You can define a output separator for the HTML Cloud
decorator&lt;zend.tag.cloud.decorators.htmlcloud&gt;.

The following example shows how create the **same** tag cloud from a `Zend\Config\Config` object.

```php
# An example tags.ini file
tags.1.title = "Code"
tags.1.weight = 50
tags.1.params.url = "/tag/code"
tags.2.title = "Zend Framework"
tags.2.weight = 1
tags.2.params.url = "/tag/zend-framework"
tags.3.title = "PHP"
tags.3.weight = 2
tags.3.params.url = "/tag/php"
```

```php
// Create the cloud from a Zend\Config\Config object
$config = Zend\Config\Factory::fromFile('tags.ini');
$cloud = new Zend\Tag\Cloud($config);

// Render the cloud
echo $cloud;
```

## Decorators

`Zend\Tag\Cloud` requires two types of decorators to be able to render a tag cloud. This includes a
decorator which renders the single tags as well as a decorator which renders the surrounding cloud.
`Zend\Tag\Cloud` ships a default decorator set for formatting a tag cloud in *HTML*. This set will,
by default, create a tag cloud as ul/li -list, spread with different font-sizes according to the
weight values of the tags assigned to them.

### HTML Tag decorator

The *HTML* tag decorator will by default render every tag in an anchor element, surrounded by a
`<li>` element. The anchor itself is fixed and cannot be changed, but the surrounding element(s)
can.

> ## Note
#### URL parameter
As the *HTML* tag decorator always surounds the tag title with an anchor, you should define a *URL*
parameter for every tag used in it.

The tag decorator can either spread different font-sizes over the anchors or a defined list of
classnames. When setting options for one of those possibilities, the corresponding one will
automatically be enabled. The following configuration options are available:

The following example shows how to create a tag cloud with a customized *HTML* tag decorator.

```php
$cloud = new Zend\Tag\Cloud(array(
    'tagDecorator' => array(
        'decorator' => 'htmltag',
        'options'   => array(
            'minFontSize' => '20',
            'maxFontSize' => '50',
            'htmlTags'    => array(
                'li' => array('class' => 'my_custom_class'),
            ),
        ),
    ),
    'tags' => array(
       array(
           'title'  => 'Code',
           'weight' => 50,
           'params' => array('url' => '/tag/code'),
       ),
       array(
           'title'  => 'Zend Framework',
           'weight' => 1,
           'params' => array('url' => '/tag/zend-framework'),
       ),
       array(
           'title'  => 'PHP',
           'weight' => 5,
           'params' => array('url' => '/tag/php')
       ),
   ),
));

// Render the cloud
echo $cloud;
```

The output:

```php
<ul class="zend-tag-cloud">
    <li class="my_custom_class">
        <a href="/tag/code" style="font-size: 50px;">Code</a>
    </li>
    <li class="my_custom_class">
        <a href="/tag/zend-framework" style="font-size: 20px;">Zend Framework</a>
    </li>
    <li class="my_custom_class">
        <a href="/tag/php" style="font-size: 23px;">PHP</a>
    </li>
</ul>
```

### HTML Cloud decorator

By default the *HTML* cloud decorator will surround the *HTML* tags with a `<ul>` element and add no
separation. Like in the tag decorator, you can define multiple surrounding *HTML* tags and
additionally define a separator. The available options are:

```php
// Create the cloud and assign static tags to it
$cloud = new Zend\Tag\Cloud(array(
    'cloudDecorator' => array(
        'decorator' => 'htmlcloud',
        'options'   => array(
            'separator' => "\n\n",
            'htmlTags'  => array(
                'ul' => array(
                    'class' => 'my_custom_class',
                    'id'    => 'tag-cloud',
                ),
            ),
        ),
    ),
    'tags' => array(
        array(
            'title'  => 'Code',
            'weight' => 50,
            'params' => array('url' => '/tag/code'),
        ),
        array(
            'title'  => 'Zend Framework',
            'weight' => 1,
            'params' => array('url' => '/tag/zend-framework'),
        ),
        array(
            'title' => 'PHP',
            'weight' => 5,
            'params' => array('url' => '/tag/php'),
        ),
    ),
));

// Render the cloud
echo $cloud;
```

The ouput:

```php
<ul class="my_custom_class" id="tag-cloud"><li><a href="/tag/code" style="font-size:
20px;">Code</a></li>

<li><a href="/tag/zend-framework" style="font-size: 10px;">Zend Framework</a></li>

<li><a href="/tag/php" style="font-size: 11px;">PHP</a></li></ul>
```
