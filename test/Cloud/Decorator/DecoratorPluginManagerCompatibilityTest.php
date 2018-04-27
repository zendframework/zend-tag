<?php
/**
 * @see       https://github.com/zendframework/zend-tag for the canonical source repository
 * @copyright Copyright (c) 2005-2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-tag/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\ServiceManager;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Test\CommonPluginManagerTrait;
use Zend\Tag\Cloud\Decorator\DecoratorInterface;
use Zend\Tag\Cloud\DecoratorPluginManager;

/**
 * Example test of using CommonPluginManagerTrait
 */
class DecoratorPluginManagerCompatibilityTest extends TestCase
{
    use CommonPluginManagerTrait;

    protected function getPluginManager()
    {
        return new DecoratorPluginManager(new ServiceManager());
    }

    protected function getV2InvalidPluginException()
    {
        return \RuntimeException::class;
    }

    protected function getInstanceOf()
    {
        return DecoratorInterface::class;
    }
}
