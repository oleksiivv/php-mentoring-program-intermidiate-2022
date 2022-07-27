<?php

namespace solid\Repositories\Interfaces;

use solid\Entities\Interfaces\ReadableObject;

interface ReadableObjectRepositoryInterface extends PerformModifications, PerformFetch
{
    const PAGINATION_ITEMS_PER_PAGE = 5;
    const PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE = 2;
}