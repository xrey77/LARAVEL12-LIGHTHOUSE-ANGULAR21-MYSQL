<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

final readonly class ProductReport
{

 
    /**
     * @param  null  $_
     * @param  array{}  $args
     * @return array{filename: string, base64: string}
     */
    public function __invoke($_, array $args): array
    {
        ini_set('memory_limit', '712M'); 
        set_time_limit(300); // 5 minutes
        $products = Product::all(); 

        $path = public_path('images/logo.png'); 
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = Pdf::loadView('pdf.product_report', [
            'products' => $products,
            'logo' => $logoBase64
        ])->setPaper('a4', 'portrait')->setOption('isPhpEnabled', true);


        return [
            'filename' => "product-report-" . now()->timestamp . ".pdf",
            'base64' => base64_encode($pdf->output())
        ];

    }
}


// ==========Request===============
// query {
//     productReport {
//         id
//         category
//         descriptions
//         qty
//         unit
//         costprice
//         sellprice
//         saleprice
//     }
// }