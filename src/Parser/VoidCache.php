<?php

namespace Zheltikov\TypeAssert\Parser;

use RuntimeException;
use Zheltikov\Memoize\Cache;

class VoidCache implements Cache
{
    /**
     * @return $this
     */
    public function clear(): self
    {
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set(string $key, $value): self
    {
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        throw new RuntimeException('Cannot get from VoidCache!');
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isset(string $key): bool
    {
        return false;
    }
}
