<?php

namespace Exorg\Solibra\CheckingOut;

use Exorg\Solibra\CheckingOut\BookAccessing;

class BookReadersGroup
{
    use BookAccessing;

    public function __construct(Access $access)
    {
        $this->access = $access;
    }
}