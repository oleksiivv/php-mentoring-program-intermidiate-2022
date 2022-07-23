<?php

namespace http_part_1\Services;

use Symfony\Component\HttpFoundation\Request;

class HttpService
{
    public const BASE_LOCAL_URL = 'http://localhost/php-mentoring-program-intermidiate-2022/src/http_part_1/Views/index.php';

    public function addParamToURL(Request $request, string $param, $value): string
    {
        $request->query->set($param, $value);

        if ($param !== 'page') {
            $request->query->set('page', 1);
        }

        return $request->getBaseUrl() . '?' . http_build_query($request->query->all());
    }

    public function addOrderParam(Request $request, string $param): string
    {
        $order = 'ASC';

        if (isset($request->get('order')[$param])) {
            $order = $request->get('order')[$param] === 'ASC' ? 'DESC' : 'ASC';
        }

        return $this->addParamToURL($request, 'order', [$param => $order]);
    }
}