<?php

namespace App\Service;

use App\Entity\Link;

interface LinkMinimizerInterface
{
    public function minimize(Link $link);
}