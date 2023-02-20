<?php

namespace App\Constants;

use App\Models\Like;

class Common

{

    const ORDER_RECOMMEND = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const ORDER_NEWER = '3';
    const ORDER_OLDER = '4';


    const SORT_ORDER = [
        'recommend' => self::ORDER_RECOMMEND,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
        'newerItem' => self::ORDER_NEWER,
        'olderItem' => self::ORDER_OLDER,
    ];
}
