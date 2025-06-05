<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $weekStart = request('from') ? Carbon::parse(request('from'))->addHours(24) : Carbon::now()->subDays(7);
        $weekEnd = request('to') ? Carbon::parse(request('to'))->addHours(24) : Carbon::now();
        $chart = Visitor::whereBetween('created_at', [$weekStart, $weekEnd])->get();

        return response()->json([
            'chart' => $chart,
        ]);
    }

    public function contact()
    {
        $contact = ContactRequest::where(function ($query) {
                $query->orWhere('name', 'like', "%". request('search') ."%");
                $query->orWhere('email', 'like', "%". request('search') ."%");
                $query->orWhere('phone', 'like', "%". request('search') ."%");
                $query->orWhere('subject', 'like', "%". request('search') ."%");
        })->paginate(request('limit') ?? 5);

        return response()->json([
            'contact' => $contact,
        ]);
    }

    public function visitor()
    {

        $visitors = Visitor::paginate(request('limit') ?? 5);

        return response()->json([
            'visitors' => $visitors,
        ]);
    }
}
