<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $reports = Report::count();
        $rewards = Reward::count();
        $citizens = User::getAllCitizens()->count();

        return view('admin.admin_dashboard', compact('categories', 'reports', 'rewards', 'citizens'));
    }
}
