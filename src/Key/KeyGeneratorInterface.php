<?php

/*
 * This file is part of the Lockbox package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Eloquent\Lockbox\Key;

/**
 * The interface implemented by encryption key generators.
 */
interface KeyGeneratorInterface
{
    /**
     * Generate a new key.
     *
     * @param integer|null $encryptionSecretSize     The size of the encryption secret in bits.
     * @param integer|null $authenticationSecretSize The size of the authentication secret in bits.
     * @param string|null  $name                     The name.
     * @param string|null  $description              The description.
     *
     * @return KeyInterface                      The generated key.
     * @throws Exception\InvalidKeySizeException If the requested key size is invalid.
     */
    public function generateKey(
        $encryptionSecretSize = null,
        $authenticationSecretSize = null,
        $name = null,
        $description = null
    );
}
