<?php

/*
 * This file is part of the Lockbox package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Eloquent\Lockbox\Password\Stream\Filter;

use Eloquent\Lockbox\Cipher\CipherInterface;
use Eloquent\Lockbox\Password\Cipher\PasswordDecryptCipher;
use Eloquent\Lockbox\Stream\Filter\AbstractCipherStreamFilter;

/**
 * A stream filter for decryption with a password.
 */
class PasswordDecryptStreamFilter extends AbstractCipherStreamFilter
{
    /**
     * Create the cipher.
     *
     * @return CipherInterface The cipher.
     */
    protected function createCipher()
    {
        return new PasswordDecryptCipher;
    }
}
