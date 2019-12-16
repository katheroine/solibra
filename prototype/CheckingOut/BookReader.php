<?php

namespace Exorg\Solibra\CheckingOut;

use Exorg\Solibra\CheckingOut\BookAccessing;
use Exorg\Solibra\CheckingOut\BookReadersGroup;
use Exorg\Solibra\CheckingOut\Book;
use Exorg\Solibra\CheckingOut\AccessType;

class BookReader
{
    use BookAccessing;

    private Book $book;
    private array $groups;

    /**
     * @param BookReadersGroup[] $groups
     * @param Book $book
     * @param Access $access
     */
    public function __construct(Book $book, Access $access, array $groups = [])
    {
        $this->groups = $groups;
        $this->book = $book;
        $this->access = $access;
    }

    public function canLend(): bool
    {
        if ($this->access->getType() === AccessType::BORROW) {
            return true;
        }

        foreach ($this->groups as $group) {
            if ($group->getAccess()->getType() === AccessType::BORROW) {
                return true;
            }
        }

        return false;
    }
}
