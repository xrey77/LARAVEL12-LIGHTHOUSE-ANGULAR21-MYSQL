<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use GraphQL\Error\Error;
// use Nuwave\Lighthouse\Exceptions\ValidationException;

final readonly class ProductsList
{
    /**
     * @param  null  $_
     * @param  array{first: int, page: int}  $args
     * @return LengthAwarePaginator
     */
    public function __invoke(null $_, array $args): LengthAwarePaginator
    {
        $perPage = $args['first'] ?? 5;
        $page = $args['page'] ?? 1;

        $paginator = Product::query()->paginate($perPage, ['*'], 'page', $page);

        if ($page > $paginator->lastPage() && $paginator->total() > 0) {
            throw new Error("Requested page {$page} is out of range. Maximum page is {$paginator->lastPage()}.");
        }        

        return $paginator;
    }
}

// ===============Request=====================
// query ProductsList($page: Int!) {
//     productsList(first: 5, page: $page) {
//         data {
//             id
//             category
//             descriptions
//             qty
//             unit
//             costprice
//         }
//         paginatorInfo {
//             currentPage
//             lastPage
//             total
//             hasMorePages
//         }
//     }
// }

// ===============Variables==================
// {
//     "page": 1
// }