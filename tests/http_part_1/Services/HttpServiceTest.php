<?php

namespace Tests\http_part_1\Services;

use http_part_1\Services\HttpService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

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
        $request = new Request(request: [json_encode(['page' => '1'])]);

        $newQueryParam = 'test_param';
        $newQueryParamValue = 'test_value';

        $result = $this->httpService->addParamToURL($request, $newQueryParam, $newQueryParamValue);

        $this->assertStringContainsString('page=1', $result);
        $this->assertStringContainsString("$newQueryParam=$newQueryParamValue", $result);
    }

    public function testAddOrderParamToUrlWorksCorrectly()
    {
        $request = new Request(request: [json_encode(['page' => '1'])]);

        $order = 'title';

        $orderDirection = 'ASC';

        $result = $this->httpService->addOrderParam($request, $order);

        $this->assertStringContainsString('page=1', $result);
        $this->assertStringContainsString("order%5B$order%5D=$orderDirection", $result);
    }
}