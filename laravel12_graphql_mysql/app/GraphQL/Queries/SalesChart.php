<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;


final readonly class SalesChart
{
        /**
     * @param  null  $_
     * @param  array{}  $args
     * @return Collection<int, Sale>
     */    
    public function __invoke($_, array $args): Collection
    {
        return Sale::all();
    }
}


// ======Request=========
// query {
//     salesChart {
//         amount
//         date
//     }
// }