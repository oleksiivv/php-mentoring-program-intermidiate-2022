<?php

namespace solid\Services;

class HttpService
{
    public function addParamToURL(string $param, $value): string
    {
        $query = $_GET;

        if ($param !== 'page') {
            $query['page'] = 1;
        }

        $query[$param] = $value;
        $query = http_build_query($query);

        return $_SERVER['PHP_SELF'] . '?' . $query;
    }

    public function addOrderParam(string $param): string
    {
        $order = 'ASC';

        if (isset($_GET['order'][$param])) {
            $order = $_GET['order'][$param] === 'ASC' ? 'DESC' : 'ASC';
        }

        return $this->addParamToURL('order', [$param => $order]);
    }
}