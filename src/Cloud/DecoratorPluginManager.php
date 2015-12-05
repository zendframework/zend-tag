<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Tag\Cloud;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Plugin manager implementation for decorators.
 *
 * Enforces that decorators retrieved are instances of
 * Decorator\DecoratorInterface. Additionally, it registers a number of default
 * decorators available.
 */
class DecoratorPluginManager extends AbstractPluginManager
{
    protected $aliases = [
        'htmlcloud' => Decorator\HtmlCloud::class,
        'htmltag'   => Decorator\HtmlTag::class,
        'tag'       => Decorator\HtmlTag::class,
    ];

    protected $factories = [
        Decorator\HtmlCloud::class => InvokableFactory::class,
        Decorator\HtmlTag::class   => InvokableFactory::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Decorator\DecoratorInterface) {
            // we're okay
            return;
        }

        throw new InvalidServiceException(sprintf(
            'Plugin of type %s is invalid; must implement %s\Decorator\DecoratorInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
