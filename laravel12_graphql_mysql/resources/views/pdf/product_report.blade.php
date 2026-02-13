<html>
<head>
   <style>
        body {
            background-color: #000;
        }
        @page {
            margin: 100px 25px;
        }
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            font-family: Helvetica;
            font-size: 12px;
        }
    </style>    
</head>
<body>
    <!-- <footer>
        Page <span class="pagenum"></span>
    </footer> -->

    <main>
        <img style="width:150px; height:45px;" src="{{ $logo }}" alt="" />
        <h1 style="font-family: Helvetica;">Product Report</h1>
        <p  style="font-family: Helvetica;margin-top: -20px;" >{{ "As of " . now()->format('F j, Y'); }}</p>
        <table>
        <thead>
            <tr>
            <th style="font-family: Helvetica;width: 50px;background-color: #000;color: #FFF;text-align: center;">#</th>
            <th style="font-family: Helvetica;width: 150px;background-color: #000;color: #FFF;">description</th>
            <th style="font-family: Helvetica;width: 50px;background-color: #000;color: #FFF;text-align: center;">Stocks</th>
            <th style="font-family: Helvetica;width: 100px;background-color: #000;color: #FFF;text-align: center;">Unit</th>
            <th style="font-family: Helvetica;width: 100px;background-color: #000;color: #FFF;text-align: center;">Price</th>
            </tr>
        </thead>
        <tbody>
                @foreach($products as $product)
                    <tr>
                        <td style="font-family: Helvetica;width: 50px;text-align: center;">{{ $product->id }}</td>
                        <td style="font-family: Helvetica;width: 250px;">{{ $product->descriptions}}</td>
                        <td style="font-family: Helvetica;width: 50px;text-align: center;">{{ $product->qty}}</td>
                        <td style="font-family: Helvetica;width: 100px;text-align: center;">{{ $product->unit}}</td>
                        <td style="font-family: Helvetica;width: 100px;text-align: center;">{{ $product->sellprice}}</td>
                    </tr>
                @endforeach
        </tbody>
        </table>

    </main>

    <!-- Script to inject page numbers -->
    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->get_font("Helvetica", "normal");
            $size = 10;
            $pageText = "Page {PAGE_NUM} of {PAGE_COUNT}";
            $y = $pdf->get_height() - 35;
            $x = ($pdf->get_width() / 2) - 35;
            $pdf->page_text($x, $y, $pageText, $font, $size, array(0,0,0));
        }
    </script>
</body>
</html>
