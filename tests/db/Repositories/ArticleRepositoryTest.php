<?php

namespace Tests\db\Repositories;

use db\Entities\Article;
use db\Repositories\ArticleRepository;
use PHPUnit\Framework\TestCase;
use Tests\db\DoctrineTestCase;

class ArticleRepositoryTest extends TestCase
{
    use DoctrineTestCase;

    protected ArticleRepository $articleRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $em = $this->getEntityManager();

        $this->articleRepository = new ArticleRepository($em);
    }

    public function testCreateWorksCorrectly()
    {
        $data = [
            'title' => 'Test title',
            'description' => 'Test description',
        ];

        $foundArticle = $this->articleRepository->find(
            $this->articleRepository->create($data)->getId()
        );

        $this->assertInstanceOf(Article::class, $foundArticle);
        $this->assertSame($data['title'], $foundArticle->getTitle());
        $this->assertSame($data['description'], $foundArticle->getDescription());
    }

    public function testUpdateWorksCorrectly()
    {
        $initialData = [
            'title' => 'Test title',
            'description' => 'Test description',
        ];

        $updatedData = [
            'title' => 'Test title',
            'description' => 'Test description',
        ];

        $articleId = $this->articleRepository->create($initialData)->getId();

        $updatedArticleId = $this->articleRepository->update($articleId, $updatedData)->getId();

        $updatedArticle = $this->articleRepository->find($updatedArticleId);

        $this->assertInstanceOf(Article::class, $updatedArticle);
        $this->assertSame($updatedData['title'], $updatedArticle->getTitle());
        $this->assertSame($updatedData['description'], $updatedArticle->getDescription());
    }

    public function testDeleteWorksCorrectly()
    {
        $data = [
            'title' => 'Test title',
            'description' => 'Test description',
        ];

        $articleId = $this->articleRepository->create($data)->getId();

        $this->articleRepository->delete($articleId);

        $this->assertNull($this->articleRepository->find($articleId));
    }

    public function testPaginationWorksCorrectly()
    {
        $articlesData = $this->getTestArticlesData();

        foreach ($articlesData as $singleArticleData) {
            $this->articleRepository->create($singleArticleData);
        }

        $start = 4;
        $offset = 2;

        $twoLastArticles = $this->articleRepository->index($start, $offset);

        $this->assertCount($offset, $twoLastArticles);

        for ($i = $start; $i < $start + $offset; $i++) {
            $this->assertSame($articlesData[$i]['title'], $twoLastArticles[$i - $start]->getTitle());
            $this->assertSame($articlesData[$i]['description'], $twoLastArticles[$i - $start]->getDescription());
        }
    }

    public function testOrderByWorksCorrectly()
    {
        $articlesData = $this->getTestArticlesData();

        foreach ($articlesData as $singleArticleData) {
            $this->articleRepository->create($singleArticleData);
        }

        $articlesAsc = $this->articleRepository->index(0, count($articlesData), [
            'title' => 'ASC',
        ]);

        $articlesDesc = $this->articleRepository->index(0, count($articlesData), [
            'title' => 'DESC',
        ]);

        $this->assertCount(count($articlesData), $articlesAsc);
        $this->assertCount(count($articlesData), $articlesDesc);

        for ($i = 0; $i < count($articlesAsc); $i++) {
            //In dummy data each article title contains its number
            $this->assertStringContainsString(($i + 1), $articlesAsc[$i]->getTitle());
        }

        for ($i = 0; $i < count($articlesDesc); $i++) {
            //In dummy data each article title contains its number
            $this->assertStringContainsString((count($articlesDesc) - $i), $articlesDesc[$i]->getTitle());
        }
    }

    public function testGetNumberOfRecordsWorksCorrectly()
    {
        $articlesData = $this->getTestArticlesData();

        foreach ($articlesData as $singleArticleData) {
            $this->articleRepository->create($singleArticleData);
        }

        $numberOfRecords = $this->articleRepository->getNumberOfRecords();

        $this->assertSame(count($articlesData), $numberOfRecords);
    }

    private function getTestArticlesData(): array
    {
        return [
            [
                'title' => 'Test title article 1',
                'description' => 'Scrambled it to make a type specimen book',
            ],
            [
                'title' => 'Test title article 4',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            ],
            [
                'title' => 'Test title article 3',
                'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            ],
            [
                'title' => 'Test title article 5',
                'description' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution',
            ],
            [
                'title' => 'Test title article 2',
                'description' => 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose',
            ],
            [
                'title' => 'Test title article 6',
                'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text',
            ],
        ];
    }
}