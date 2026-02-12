<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use GraphQL\Error\Error;

final readonly class ProductsSearch
{
    /**
     * @param  null  $_
     * @param  array{first: int, page: int, keyword: ?string}  $args
     */
    public function __invoke($_, array $args): LengthAwarePaginator 
    {
        $query = Product::query();

        if (!empty($args['keyword'])) {
            $query->where('descriptions', 'like', '%' . $args['keyword'] . '%');
        }

        $perPage = $args['first'] ?? 5;
        $page = $args['page'] ?? 1;

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        if ($page > $paginator->lastPage() && $paginator->total() > 0) {
            throw new Error("Requested page {$page} is out of range. Maximum page is {$paginator->lastPage()}.");
        }

        return $paginator;
    }
}


// ========Request====================
// query ProductsSearch($keyword: String, $first: Int, $page: Int) {
//   productsSearch(keyword: $keyword, first: $first, page: $page) {
//     data {
//       id
//       category
//       descriptions
//       qty
//       unit
//       costprice
//       sellprice
//     }
//     paginatorInfo {
//       currentPage
//       lastPage
//       total
//       hasMorePages
//     }
//   }
// }


//================Variables=================
// {
//   "keyword": "30",
//   "first": 10,
//   "page": 1
// }
