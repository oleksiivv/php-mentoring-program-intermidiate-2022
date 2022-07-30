<?php

namespace Tests\solid\Services;

use solid\Services\HttpService;
use PHPUnit\Framework\TestCase;

class HttpServiceTest extends TestCase
{
    protected HttpService $httpService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpService = new HttpService();
    }

    public function testAddParamToUrlWorksCorrectly()
    {
        $_GET = ['page' => '1'];

        $newQueryParam = 'test_param';
        $newQueryParamValue = 'test_value';

        $result = $this->httpService->addParamToURL($newQueryParam, $newQueryParamValue);

        $this->assertStringContainsString('page=1', $result);
        $this->assertStringContainsString("$newQueryParam=$newQueryParamValue", $result);
    }

    public function testAddOrderParamToUrlWorksCorrectlyForAscending()
    {
        $_GET = ['page' => '1'];

        $order = 'title';

        $result = $this->httpService->addOrderParam($order);

        $this->assertStringContainsString('page=1', $result);
        $this->assertStringContainsString("order%5B$order%5D=ASC", $result);
    }

    public function testAddOrderParamToUrlWorksCorrectlyForDescending()
    {
        $order = 'title';

        $_GET = [
            'page' => '1',
            'order' => [
                $order => 'ASC',
            ],
        ];

        $result = $this->httpService->addOrderParam($order);

        $this->assertStringContainsString('page=1', $result);
        $this->assertStringContainsString("order%5B$order%5D=DESC", $result);
    }
}