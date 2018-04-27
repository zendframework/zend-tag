<?php
/**
 * @see       https://github.com/zendframework/zend-tag for the canonical source repository
 * @copyright Copyright (c) 2005-2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-tag/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Tag\Cloud\TestAsset;

class CloudDummy extends \Zend\Tag\Cloud\Decorator\HtmlCloud
{
    // @codingStandardsIgnoreStart
    protected $_foo;
    // @codingStandardsIgnoreEnd

    public function setFoo($value)
    {
        $this->_foo = $value;
    }

    public function getFoo()
    {
        return $this->_foo;
    }
}
