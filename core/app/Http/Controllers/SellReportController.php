<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellReportController extends Controller
{
    public function sellers(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $sellers = Seller::all();

        return view('reports.sellers', compact('sellers', 'year'));

        //return redirect()->route('report.sellers.search', ['year' => date('Y')]);
    }

    public function search(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $seller = $request->get('seller');
        $data = $this->getData($year, $seller);
        $sellers = $data['sellers'];
        $sells = $data['sells'];
        return view('reports.sellers', compact('sellers', 'sells', 'year', 'seller'));
    }

    public function charts(Request $request)
    {
        $year = $request->get('year', date('Y'));

        //TODO: Montar la sql buscando por el año
        // select MONTHNAME(s.created_at) as month, SUM(sl.total_price) as total
        //from sells s inner join sell_lines sl on s.id = sl.sell_id
        //           WHERE YEAR(s.created_at) = '$year'
        //group by MONTH(s.created_at)
        //ORDER BY month DESC
        $sells = "execute slq where $year";

        $labels = [];
        $values = [];
        foreach($sells as $sell){
            $labels[] = $sell['month'];
            $values[] = $sell['total'];
        }

        return json_encode([
            "labels" => $labels,
            "values" => $values,
            "chart_name" => "Ventas del año $year",
        ]);
    }

    public function pdf(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $data = $this->getData($year);
        $sells = $data['sells'];

        // Renderizamos la vista + variables = HTML
        $view = view('reports.pdf',
            compact('sells', 'year')
        )->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Sellers_report_' . $year . '.pdf');
    }

    private function getData($year, $seller_id = null)
    {
        /**
         * SELLER YEAR TOTAL
         * Pepe 2024 10.000€
         * Pepe 2024 10.000€
         * Pepe 2024 10.000€
         */

        /* SELECT CONCAT(se.name, ' ', se.surname) as seller, SUM(sl.total_price) as total
            FROM sells s
                LEFT JOIN sell_lines sl on s.id = sl.sell_id
                LEFT JOIN sellers se on s.seller_id = se.id
            WHERE YEAR(s.created_at) = '2024'
            GROUP BY s.seller_id
        */

        $sellers = Seller::all();
        $sells = Sell::whereYear('sells.created_at', $year)
            ->with('seller')
            ->get()
            ->groupBy('seller_id')
            ->map(function($seller) {
                $s = $seller->first()->seller;
                return [
                    'seller' => $s->getFullName(),
                    'total' => $seller->sum(function ($sell) {
                        return $sell->total();
                    })
                ];
            });

        if ($seller_id) {
            $sells = $sells->filter(function ($value, $key) use ($seller_id) {
                return $key == $seller_id;
            });
        }

        return [
            'sellers' => $sellers,
            'sells' => $sells,
        ];
    }

}
