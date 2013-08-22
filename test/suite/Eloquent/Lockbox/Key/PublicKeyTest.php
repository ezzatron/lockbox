<?php

/*
 * This file is part of the Lockbox package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Lockbox\Key;

use Eloquent\Liberator\Liberator;
use PHPUnit_Framework_TestCase;

/**
 * @covers Eloquent\Lockbox\Key\PublicKey
 * @covers Eloquent\Lockbox\Key\AbstractKey
 */
class PublicKeyTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->factory = new KeyFactory;
        $this->fixturePath = __DIR__ . '/../../../../fixture/pem';
    }

    public function testConstructor()
    {
        $key = $this->factory->createPublicKeyFromFile($this->fixturePath . '/rsa-2048-nopass.public.pem');

        $this->assertInternalType('resource', $key->handle());
    }

    public function keyData()
    {
        //                                        name                          password    bits  envelopeSize
        return array(
            'DSA, 2048-bit, no password' => array('dsa-2048-nopass.public.pem', null,       2048, 256),
            'DSA, 2048-bit'              => array('dsa-2048.public.pem',        'password', 2048, 256),
            'DSA, 4096-bit, no password' => array('dsa-4096-nopass.public.pem', null,       4096, 512),
            'RSA, 2048-bit, no password' => array('rsa-2048-nopass.public.pem', null,       2048, 256),
            'RSA, 2048-bit'              => array('rsa-2048.public.pem',        'password', 2048, 256),
            'RSA, 4096-bit, no password' => array('rsa-4096-nopass.public.pem', null,       4096, 512),
        );
    }

    /**
     * @dataProvider keyData
     */
    public function testKey($name, $password, $bits, $envelopeSize)
    {
        $path = sprintf('%s/%s', $this->fixturePath, $name);
        $key = $this->factory->createPublicKeyFromFile($path, $password);

        $this->assertSame($bits, $key->bits());
        $this->assertSame($envelopeSize, $key->envelopeSize());
        $this->assertSame(file_get_contents($path), $key->string());
    }

    public function testDetailFailure()
    {
        $key = Liberator::liberate(
            $this->factory->createPublicKeyFromFile($this->fixturePath . '/rsa-2048-nopass.public.pem')
        );

        $this->setExpectedException(__NAMESPACE__ . '\Exception\MissingDetailException');
        $key->detail('foo');
    }
}
