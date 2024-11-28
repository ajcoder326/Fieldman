<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Exports\ExpenseReport;
use App\Exports\LeaveReport;
use App\Exports\VisitExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function getAttendanceReport(Request $request)
    {
        $period = $request->period;

        if (!$period) {
            return redirect()->back()->with('error', 'Please select a period');
        }

        $month = date('m', strtotime($period));

        $year = date('Y', strtotime($period));

        return Excel::download(new AttendanceExport($month, $year), time() . '_attendance_report.xlsx');
    }

    public function getVisitReport(Request $request)
    {
        $period = $request->period;

        if (!$period) {
            return redirect()->back()->with('error', 'Please select a period');
        }

        $month = date('m', strtotime($period));

        $year = date('Y', strtotime($period));

        return Excel::download(new VisitExport($month, $year), time() . '_visit_report.xlsx');
    }

    public function getLeaveReport(Request $request)
    {
        $period = $request->period;

        if (!$period) {
            return redirect()->back()->with('error', 'Please select a period');
        }

        $month = date('m', strtotime($period));

        $year = date('Y', strtotime($period));

        return Excel::download(new LeaveReport($month, $year), time() . '_leave_report.xlsx');
    }

    public function getExpenseReport(Request $request)
    {
        $period = $request->period;

        if (!$period) {
            return redirect()->back()->with('error', 'Please select a period');
        }

        $month = date('m', strtotime($period));

        $year = date('Y', strtotime($period));

        return Excel::download(new ExpenseReport($month, $year), time() . '_expense_report.xlsx');
    }
}
