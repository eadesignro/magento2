<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Customer\Test\Unit\CustomerData;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

class SectionConfigConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Magento\Customer\CustomerData\SectionConfigConverter */
    protected $converter;

    /** @var ObjectManagerHelper */
    protected $objectManagerHelper;

    /** @var \DOMDocument */
    protected $source;

    protected function setUp()
    {
        $this->source = new \DOMDocument();
        $this->objectManagerHelper = new ObjectManagerHelper($this);
        $this->converter = $this->objectManagerHelper->getObject(
            \Magento\Customer\CustomerData\SectionConfigConverter::class
        );
    }

    public function testConvert()
    {
        $this->source->loadXML(file_get_contents(__DIR__ . '/_files/sections.xml'));

        $this->assertEquals(
            [
                'sections' => [
                    'customer/account/logout' => '*',
                    'customer/account/editpost' => ['account'],
                ],
            ],
            $this->converter->convert($this->source)
        );
    }
}
