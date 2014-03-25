<?php

/*
 * This file is part of the Lockbox package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Eloquent\Lockbox\Key\Exception;

use Exception;

/**
 * The supplied key is not a valid PEM formatted private key.
 */
final class InvalidPrivateKeyException extends Exception implements
    InvalidKeyExceptionInterface
{
    /**
     * Construct a new invalid private key exception.
     *
     * @param string         $key      The key.
     * @param Exception|null $previous The cause, if available.
     */
    public function __construct($key, Exception $previous = null)
    {
        $this->key = $key;

        parent::__construct(
            'The supplied key is not a valid PEM formatted private key.',
            0,
            $previous
        );
    }

    /**
     * Get the key.
     *
     * @return string The key.
     */
    public function key()
    {
        return $this->key;
    }

    private $key;
}
