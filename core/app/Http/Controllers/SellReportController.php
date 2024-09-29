<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellReportController extends Controller
{
    public function sellers()
    {
        return redirect()->route('report.sellers.search', ['year' => date('Y')]);
    }

    public function search(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $sellers = Seller::all();

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

        $sells = Sell::whereYear('sells.created_at', $year)
            ->with('seller')
            ->get()
            ->groupBy('seller_id')
            ->map(function($seller) {
                $s = $seller->first()->seller;
                return [
                    'seller' => $s->name . ' ' . $s->surname,
                    'total' => $seller->sum(function($sell) {
                        return $sell->total();
                    })
                ];
            });

        return view('reports.sellers', compact('sellers', 'sells', 'year'));
    }
}
