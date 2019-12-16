<?php

use PHPUnit\Framework\TestCase;
use Exorg\Solibra\CheckingOut\Book;
use Exorg\Solibra\CheckingOut\Access;
use Exorg\Solibra\CheckingOut\AccessType;
use Exorg\Solibra\CheckingOut\BookReadersGroup;
use Exorg\Solibra\CheckingOut\BookReader;

class BookReaderTest extends TestCase
{
    public function testBookReaderCannotLendBookWithNoPersonalAccessAndNoGroup()
    {
        $book = new Book();
        $access = new Access('');

        $bookReader = new BookReader(
            $book,
            $access
        );

        $this->assertFalse(
            $bookReader->canLend()
        );
    }

    public function testBookReaderCanLendBookWithPersonalAccessAndNoGroup()
    {
        $book = new Book();
        $access = new Access(AccessType::BORROW);

        $bookReader = new BookReader(
            $book,
            $access
        );

        $this->assertTrue(
            $bookReader->canLend()
        );
    }

    public function testBookReaderCanLendBookWithNoPersonalAccessAndGroupWithNoAccess()
    {
        $book = new Book();
        $readerAccess = new Access('');
        $groupAccess = new Access('');
        $group = new BookReadersGroup($groupAccess);
        $groups = [
            $group
        ];

        $bookReader = new BookReader(
            $book,
            $readerAccess,
            $groups
        );

        $this->assertFalse(
            $bookReader->canLend()
        );
    }

    public function testBookReaderCanLendBookWithNoPersonalAccessAndGroupWithAccess()
    {
        $book = new Book();
        $readerAccess = new Access('');
        $groupAccess = new Access(AccessType::BORROW);
        $group = new BookReadersGroup($groupAccess);
        $groups = [
            $group
        ];

        $bookReader = new BookReader(
            $book,
            $readerAccess,
            $groups
        );

        $this->assertTrue(
            $bookReader->canLend()
        );
    }

    public function testBookReaderCanLendBookWithPersonalAccessAndGroupWithAccess()
    {
        $book = new Book();
        $readerAccess = new Access(AccessType::BORROW);
        $groupAccess = new Access(AccessType::BORROW);
        $group = new BookReadersGroup($groupAccess);
        $groups = [
            $group
        ];

        $bookReader = new BookReader(
            $book,
            $readerAccess,
            $groups
        );

        $this->assertTrue(
            $bookReader->canLend()
        );
    }
}