<?php

namespace App\Service;

use App\Entity\Link;

class UrlMinimizer implements LinkMinimizerInterface
{
    /**
     * The base.
     *
     * @var string
     */
    private static $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function minimize(Link $link): string
    {
        return $this->convertIdToShortCode($link->getId());
    }

    /**
     * Convert from base 10 to another base.
     * (generate base62 string)
     *
     * @param int $id
     * @param int $b
     *
     * @return string
     */
    private function convertIdToShortCode(int $id, $b = 62): string
    {
        if ($id < 1) {
            throw new \InvalidArgumentException('ID could not be less than 1');
        }

        $r = $id % $b;
        $result = static::$base[$r];
        $q = floor($id / $b);

        while ($q)
        {
            $r = $q % $b;
            $q = floor($q / $b);
            $result = static::$base[$r].$result;
        }

        return $result;
    }
}