<?php

/*
 * This file is part of the Lockbox package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Eloquent\Lockbox\Password\Cipher;

use Eloquent\Lockbox\Cipher\AbstractEncryptCipher;
use Eloquent\Lockbox\Key\Exception\InvalidKeyExceptionInterface;
use Eloquent\Lockbox\Key\KeyDeriver;
use Eloquent\Lockbox\Key\KeyDeriverInterface;
use Eloquent\Lockbox\Padding\PadderInterface;
use Eloquent\Lockbox\Random\RandomSourceInterface;

/**
 * Encrypts data with a password.
 */
class PasswordEncryptCipher extends AbstractEncryptCipher implements
    PasswordEncryptCipherInterface
{
    /**
     * Construct a new password encrypt cipher.
     *
     * @param KeyDeriverInterface|null   $keyDeriver   The key deriver to use.
     * @param RandomSourceInterface|null $randomSource The random source to use.
     * @param PadderInterface|null       $padder       The padder to use.
     */
    public function __construct(
        KeyDeriverInterface $keyDeriver = null,
        RandomSourceInterface $randomSource = null,
        PadderInterface $padder = null
    ) {
        if (null === $keyDeriver) {
            $keyDeriver = KeyDeriver::instance();
        }

        parent::__construct($randomSource, $padder);

        $this->keyDeriver = $keyDeriver;
    }

    /**
     * Get the key deriver.
     *
     * @return KeyDeriverInterface The key deriver.
     */
    public function keyDeriver()
    {
        return $this->keyDeriver;
    }

    /**
     * Initialize this cipher.
     *
     * @param string      $password   The password to encrypt with.
     * @param integer     $iterations The number of hash iterations to use.
     * @param string|null $salt       The salt to use for key derivation, or null to generate one.
     * @param string|null $iv         The initialization vector to use, or null to generate one.
     *
     * @throws InvalidKeyExceptionInterface If the supplied arguments are invalid.
     */
    public function initialize($password, $iterations, $salt = null, $iv = null)
    {
        $this->iterations = $iterations;

        list($key, $this->salt) = $this->keyDeriver()
            ->deriveKeyFromPassword($password, $iterations, $salt);

        parent::doInitialize($key, $iv);
    }

    /**
     * Get the encryption header.
     *
     * @param string $iv The initialization vector.
     *
     * @return string The header.
     */
    protected function header($iv)
    {
        return chr(1) . chr(2) . pack('N', $this->iterations) . $this->salt .
            $iv;
    }

    private $keyDeriver;
    private $iterations;
    private $salt;
}
