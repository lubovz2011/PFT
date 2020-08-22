<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function attachFiltersToQuery(Relation $query, Request $request)
    {
        return $query->when(!empty($request->input('filter-types')), function ($query) use ($request) {
            $query->where('transactions.type', $request->input('filter-types'));
        })
        ->when(!empty($request->input('filter-accounts')), function ($query) use ($request) {
            $query->whereIn('account_id', $request->input('filter-accounts'));
        })
        ->when(!empty($request->input('filter-categories')), function ($query) use ($request) {
            $query->whereIn('category_id', $request->input('filter-categories'));
        });
    }

    protected function attachFilterTimesToQuery(Relation $query, Request $request, bool $useDefault = false){
        switch ($request->input('filter-times')) {
            case 1: $query->where('date', '=', Carbon::now()); break; //today
            case 2: $query->where('date', '=', Carbon::now()->subDay()); break; //yesterday
            case 3: $query->where('date', '>', Carbon::now()->subDays(7))
                ->where('date', '<=', Carbon::now()); break; //last 7 days
            case 4: $query->where('date', '>', Carbon::now()->subDays(30))
                ->where('date', '<=', Carbon::now()); break; // Last 30 days
            case 5: $query->where('date', '>=', Carbon::now()->firstOfMonth())
                ->where('date', '<=', Carbon::now()); break; // This Month
            case 6: $query->where('date', '>=', Carbon::now()->subMonth()->firstOfMonth())
                ->where('date', '<=', Carbon::now()->subMonth()->lastOfMonth()); break; // Last Month
            default:
                if($useDefault) {
                    $date = Carbon::parse($request->input('filter-times'));
                    $query->where('date', '>=', (clone $date)->firstOfMonth())
                        ->where('date', '<=', (clone $date)->lastOfMonth());
                }
        }
        return $query;
    }
}
