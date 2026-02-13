<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final readonly class ProductData
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     * @return Collection<int, Product>
     */
    public function __invoke($_, array $args): Collection
    {
        return Product::all();
    }
}


#Request
// query ProductData {
//     productData {
//         id,
//         category
//         descriptions
//         qty
//         unit
//         sellprice
//     }
// }   