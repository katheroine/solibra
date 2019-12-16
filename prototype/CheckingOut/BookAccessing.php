<?php

namespace Exorg\Solibra\CheckingOut;

use Exorg\Solibra\CheckingOut\Access;

trait BookAccessing
{
    private Access $access;

    public function getAccess(): Access
    {
        return $this->access;
    }
}
