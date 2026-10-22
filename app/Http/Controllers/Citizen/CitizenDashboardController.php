<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\PointLedger;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitizenDashboardController extends Controller
{
    public function landingPage()
    {
        $reports = Report::getAllReportsPaginate();
        $reportCount = Report::count();
        $reportResolved = Report::getResolvedReports()->count();
        $citizens = User::getAllCitizens()->count();

        return view('citizen.landing_page', compact('reports', 'reportCount', 'reportResolved', 'citizens'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        $totalPoints = PointLedger::getTotalPoints($user->id);

        $paginateUserReports = Report::getUserPaginateReports();

        $reportUserCount = Report::getUserReports()->count();
        $reportVerified = Report::getUserVerifiedReports()->count();
        $reportInProgress = Report::getUserInProgressReports()->count();
        $reportResolved = Report::getUserResolvedReports()->count();
        $reportRejected = Report::getUserRejectedReports()->count();

        return view('citizen.dashboard', compact(
            'user',
            'paginateUserReports',
            'totalPoints',
            'reportUserCount',
            'reportVerified',
            'reportInProgress',
            'reportResolved',
            'reportRejected'
        ));
    }
}
