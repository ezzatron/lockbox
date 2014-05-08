<?php

/*
 * This file is part of the Lockbox package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Eloquent\Lockbox\Cipher;

use Eloquent\Lockbox\Key\KeyInterface;

/**
 * Encrypts data with a key.
 */
class EncryptCipher extends AbstractEncryptCipher implements
    EncryptCipherInterface
{
    /**
     * Initialize this cipher.
     *
     * @param KeyInterface $key The key to use.
     * @param string|null  $iv  The initialization vector to use, or null to generate one.
     */
    public function initialize(KeyInterface $key, $iv = null)
    {
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
        return chr(1) . chr(1) . $iv;
    }
}
