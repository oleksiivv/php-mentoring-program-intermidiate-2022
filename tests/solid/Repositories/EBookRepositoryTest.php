<?php

namespace Tests\solid\Repositories;

use solid\Entities\EBook;
use solid\Repositories\EBookRepository;
use PHPUnit\Framework\TestCase;
use Tests\solid\DoctrineTestCase;

class EBookRepositoryTest extends TestCase
{
    use DoctrineTestCase;

    protected EBookRepository $eBookRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $em = $this->getEntityManager();

        $this->eBookRepository = new EBookRepository($em);
    }

    public function testCreateWorksCorrectly()
    {
        $data = [
            'name' => 'Test book 1',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
            'authorFullName' => 'J J Johns',
        ];

        $foundBook = $this->eBookRepository->find(
            $this->eBookRepository->create($data)->getId()
        );

        $this->assertInstanceOf(EBook::class, $foundBook);
        $this->assertSame($data['name'], $foundBook->getName());
    }

    public function testUpdateWorksCorrectly()
    {
        $initialData = [
            'name' => 'Test book 1',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
            'authorFullName' => 'J J Johns',
        ];

        $updatedData = [
            'name' => 'Test book 1 updated',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
            'authorFullName' => 'J J Johns',
        ];

        $articleId = $this->eBookRepository->create($initialData)->getId();

        $updatedBookId = $this->eBookRepository->update($articleId, $updatedData)->getId();

        $updatedBook = $this->eBookRepository->find($updatedBookId);

        $this->assertInstanceOf(EBook::class, $updatedBook);
        $this->assertSame($updatedData['name'], $updatedBook->getName());
    }

    public function testDeleteWorksCorrectly()
    {
        $data = [
            'name' => 'Test book 1',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
            'authorFullName' => 'J J Johns',
        ];

        $articleId = $this->eBookRepository->create($data)->getId();

        $this->eBookRepository->delete($articleId);

        $this->assertNull($this->eBookRepository->find($articleId));
    }

    public function testPaginationWorksCorrectly()
    {
        $booksData = $this->getTestBooksData();

        foreach ($booksData as $singleBookData) {
            $this->eBookRepository->create($singleBookData);
        }

        $start = 4;
        $offset = 2;

        $twoLastBooks = $this->eBookRepository->index($start, $offset);

        $this->assertCount($offset, $twoLastBooks);

        for ($i = $start; $i < $start + $offset; $i++) {
            $this->assertSame($booksData[$i]['name'], $twoLastBooks[$i - $start]->getName());
        }
    }

    public function testOrderByWorksCorrectly()
    {
        $booksData = $this->getTestBooksData();

        foreach ($booksData as $singleBookData) {
            $this->eBookRepository->create($singleBookData);
        }

        $booksAsc = $this->eBookRepository->index(0, count($booksData), [
            'name' => 'ASC',
        ]);

        $booksDesc = $this->eBookRepository->index(0, count($booksData), [
            'name' => 'DESC',
        ]);

        $this->assertCount(count($booksData), $booksAsc);
        $this->assertCount(count($booksData), $booksDesc);

        for ($i = 0; $i < count($booksAsc); $i++) {
            //In dummy data each article title contains its number
            $this->assertStringContainsString(($i + 1), $booksAsc[$i]->getName());
        }

        for ($i = 0; $i < count($booksDesc); $i++) {
            //In dummy data each article title contains its number
            $this->assertStringContainsString((count($booksDesc) - $i), $booksDesc[$i]->getName());
        }
    }

    public function testGetNumberOfRecordsWorksCorrectly()
    {
        $booksData = $this->getTestBooksData();

        foreach ($booksData as $singleBookData) {
            $this->eBookRepository->create($singleBookData);
        }

        $numberOfRecords = $this->eBookRepository->getNumberOfRecords();

        $this->assertSame(count($booksData), $numberOfRecords);
    }

    private function getTestBooksData(): array
    {
        return [
            [
                'name' => 'Test book 1',
                'description' => 'Scrambled it to make a type specimen book',
                'numberOfPages' => 225,
                'authorFullName' => 'J J Johns',
            ],
            [
                'name' => 'Test book 4',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'numberOfPages' => 230,
                'authorFullName' => 'J J Johns',
            ],
            [
                'name' => 'Test book 3',
                'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
                'numberOfPages' => 760,
                'authorFullName' => 'J J Johns',
            ],
            [
                'name' => 'Test book 5',
                'description' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution',
                'numberOfPages' => 220,
                'authorFullName' => 'J J Johns',
            ],
            [
                'name' => 'Test book 2',
                'description' => 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose',
                'numberOfPages' => 340,
                'authorFullName' => 'J J Johns',
            ],
            [
                'name' => 'Test book 6',
                'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text',
                'numberOfPages' => 320,
                'authorFullName' => 'J J Johns',
            ],
        ];
    }
}