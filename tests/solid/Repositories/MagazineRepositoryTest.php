<?php

namespace Tests\solid\Repositories;

use solid\Entities\Magazine;
use solid\Repositories\MagazineRepository;
use PHPUnit\Framework\TestCase;
use Tests\solid\DoctrineTestCase;

class MagazineRepositoryTest extends TestCase
{
    use DoctrineTestCase;

    protected MagazineRepository $magazineRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $em = $this->getEntityManager();

        $this->magazineRepository = new MagazineRepository($em);
    }

    public function testCreateWorksCorrectly()
    {
        $data = [
            'name' => 'Test book 1',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
        ];

        $foundBook = $this->magazineRepository->find(
            $this->magazineRepository->create($data)->getId()
        );

        $this->assertInstanceOf(Magazine::class, $foundBook);
        $this->assertSame($data['name'], $foundBook->getName());
    }

    public function testUpdateWorksCorrectly()
    {
        $initialData = [
            'name' => 'Test book 1',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
        ];

        $updatedData = [
            'name' => 'Test book 1 updated',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
        ];

        $articleId = $this->magazineRepository->create($initialData)->getId();

        $updatedBookId = $this->magazineRepository->update($articleId, $updatedData)->getId();

        $updatedBook = $this->magazineRepository->find($updatedBookId);

        $this->assertInstanceOf(Magazine::class, $updatedBook);
        $this->assertSame($updatedData['name'], $updatedBook->getName());
    }

    public function testDeleteWorksCorrectly()
    {
        $data = [
            'name' => 'Test book 1',
            'description' => 'Scrambled it to make a type specimen book',
            'numberOfPages' => 225,
            'hardCover' => true,
        ];

        $articleId = $this->magazineRepository->create($data)->getId();

        $this->magazineRepository->delete($articleId);

        $this->assertNull($this->magazineRepository->find($articleId));
    }

    public function testPaginationWorksCorrectly()
    {
        $booksData = $this->getTestBooksData();

        foreach ($booksData as $singleBookData) {
            $this->magazineRepository->create($singleBookData);
        }

        $start = 4;
        $offset = 2;

        $twoLastBooks = $this->magazineRepository->index($start, $offset);

        $this->assertCount($offset, $twoLastBooks);

        for ($i = $start; $i < $start + $offset; $i++) {
            $this->assertSame($booksData[$i]['name'], $twoLastBooks[$i - $start]->getName());
        }
    }

    public function testOrderByWorksCorrectly()
    {
        $booksData = $this->getTestBooksData();

        foreach ($booksData as $singleBookData) {
            $this->magazineRepository->create($singleBookData);
        }

        $booksAsc = $this->magazineRepository->index(0, count($booksData), [
            'name' => 'ASC',
        ]);

        $booksDesc = $this->magazineRepository->index(0, count($booksData), [
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
            $this->magazineRepository->create($singleBookData);
        }

        $numberOfRecords = $this->magazineRepository->getNumberOfRecords();

        $this->assertSame(count($booksData), $numberOfRecords);
    }

    private function getTestBooksData(): array
    {
        return [
            [
                'name' => 'Test book 1',
                'description' => 'Scrambled it to make a type specimen book',
                'numberOfPages' => 225,
                'hardCover' => true,
            ],
            [
                'name' => 'Test book 4',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'numberOfPages' => 230,
                'hardCover' => true,
            ],
            [
                'name' => 'Test book 3',
                'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
                'numberOfPages' => 760,
                'hardCover' => true,
            ],
            [
                'name' => 'Test book 5',
                'description' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution',
                'numberOfPages' => 220,
                'hardCover' => true,
            ],
            [
                'name' => 'Test book 2',
                'description' => 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose',
                'numberOfPages' => 340,
                'hardCover' => true,
            ],
            [
                'name' => 'Test book 6',
                'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text',
                'numberOfPages' => 320,
                'hardCover' => true,
            ],
        ];
    }
}