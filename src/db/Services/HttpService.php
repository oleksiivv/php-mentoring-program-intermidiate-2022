<?php

namespace db\Services;

class HttpService
{
    const PAGINATION_ITEMS_PER_PAGE = 5;
    const PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE = 2;

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