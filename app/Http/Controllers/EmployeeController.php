<?php

namespace App\Http\Controllers;

use App\Models\GeofenceGroup;
use App\Models\IpAddressGroup;
use App\Models\QRCodeGroup;
use App\Models\Settings;
use App\Models\Shift;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Sentinel;

class EmployeeController extends Controller
{
    public function index()
    {
        $role = Sentinel::findRoleBySlug('user');

        $employeeIds = $role->users()->with('roles')
            ->select('id')
            ->get();

        $ids = array_column($employeeIds->toArray(), 'id');

        $employees = User::whereIn('id', $ids)
            ->with('team')
            ->get();

        app('debugbar')->info($role);

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $managerRole = Sentinel::findRoleBySlug('manager');

        $managers = $managerRole->users()->with('roles')
            ->select('id', 'first_name', 'last_name')
            ->get();

        $shifts = Shift::where('status', '=', 'active')
            ->select('id', 'title')
            ->get();

        $teams = Team::where('status', '=', 'active')
            ->select('id', 'name')
            ->get();

        return view('employee.create', compact('managers', 'shifts', 'teams'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)
            ->with('team')
            ->with('shift')
            ->with('userDevice')
            ->first();

        $managerName = User::where('id', $user->parent_id)
            ->select('first_name', 'last_name')
            ->first();

        return view('employee.show', compact('user', 'managerName'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $managerRole = Sentinel::findRoleBySlug('manager');

        $managers = $managerRole->users()->with('roles')
            ->select('id', 'first_name', 'last_name')
            ->get();

        $managers = $managerRole->users()->with('roles')
            ->select('id', 'first_name', 'last_name')
            ->get();

        $shifts = Shift::where('status', '=', 'active')
            ->select('id', 'title')
            ->get();

        $teams = Team::where('status', '=', 'active')
            ->select('id', 'name')
            ->get();
        return view('employee.edit', compact('user', 'managers', 'shifts', 'teams'));
    }

    public function update(Request $request, $id)
    {
        if (env('DEMO_MODE')) {
            return redirect()->route('employee.show', ['id' => $id])->with('error', 'You can not change status in demo mode');
        }

        $rules = [
            'email' => 'email|unique:users,email,' . $id,
            'phoneNumber' => 'required|unique:users,phone_number,' . $id,
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'parentId' => 'required',
            'shiftId' => 'required',
            'teamId' => 'required',
            'designation' => 'required',
        ];

        $customMessages = [
            'parentId.required' => 'Manager is required',
            'shiftId.required' => 'Shift is required',
            'teamId.required' => 'Team is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $settings = Settings::first();

        $attendanceType = 'none';

        if ($request->attendanceType == '1') {
            if (!$settings->is_geofence_attendance_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'Geofence attendance module is not available!');
            }

            if ($request->geofenceGroupId == null || $request->geofenceGroupId == 0) {
                return redirect()->route('employee.create')->with('error', 'Geofence group is required!');
            }

            $attendanceType = 'geofence';
        }

        if ($request->attendanceType == '2') {
            if (!$settings->is_ip_attendance_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'IP attendance module is not available!');
            }

            if ($request->ipGroupId == null || $request->ipGroupId == 0) {
                return redirect()->route('employee.create')->with('error', 'IP group is required!');
            }

            $attendanceType = 'ip_address';
        }

        if ($request->attendanceType == '3') {
            if (!$settings->is_qr_attendance_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'QR attendance module is not available!');
            }

            if ($request->qrGroupId == null || $request->qrGroupId == 0) {
                return redirect()->route('employee.create')->with('error', 'QR code group is required!');
            }
            $attendanceType = 'static_qr_code';
        }

        if ($request->attendanceType == '5') {
            if (!$settings->is_site_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'Site attendance module is not available!');
            }

            if ($request->siteId == null || $request->siteId == 0) {
                return redirect()->route('employee.create')->with('error', 'Site is required!');
            }

            $attendanceType = 'site';
        }

        $user = User::findOrFail($id);

        if ($user->attendance_type != $attendanceType) {
            $user->attendance_type = $attendanceType;
        }

        if ($attendanceType == 'geofence') {
            if ($user->geofence_group_id != $request->geofenceGroupId) {
                $user->geofence_group_id = $request->geofenceGroupId;
            }
        }

        if ($attendanceType == 'ip_address') {
            if ($user->ip_address_group_id != $request->ipGroupId) {
                $user->ip_address_group_id = $request->ipGroupId;
            }
        }

        if ($attendanceType == 'static_qr_code') {
            if ($user->qr_code_group_id != $request->qrGroupId) {
                $user->qr_code_group_id = $request->qrGroupId;
            }
        }

        if ($attendanceType == 'site') {
            if ($user->site_id != $request->siteId) {
                $user->site_id = $request->siteId;
            }
        }

        if ($user->email != $request->email) {
            $user->email = request()->email;
        }

        if ($user->phone_number != $request->phoneNumber) {
            $user->phone_number = $request->phoneNumber;
        }

        if ($user->first_name != $request->firstName) {
            $user->first_name = $request->firstName;
        }

        if ($user->last_name != $request->lastName) {
            $user->last_name = $request->lastName;
        }

        if ($user->gender != $request->gender) {
            $user->gender = $request->gender;
        }

        if ($user->dob != $request->dob) {
            $user->dob = $request->dob;
        }

        if ($user->unique_id != $request->uniqueId) {
            $user->unique_id = $request->uniqueId;
        }

        if ($user->alternate_number != $request->alternateNumber) {
            $user->alternate_number = $request->alternateNumber;
        }

        if ($user->address != $request->address) {
            $user->address = $request->address;
        }

        if ($user->parent_id != $request->parentId) {
            $user->parent_id = $request->parentId;
        }

        if ($user->shift_id != $request->shiftId) {
            $user->shift_id = $request->shiftId;
        }

        if ($user->team_id != $request->teamId) {
            $user->team_id = $request->teamId;
        }

        if ($user->date_of_joining != $request->dateOfJoining) {
            $user->date_of_joining = $request->dateOfJoining;
        }

        if ($user->designation != $request->designation) {
            $user->designation = $request->designation;
        }

        if ($user->base_salary != $request->baseSalary) {
            $user->base_salary = $request->baseSalary;
        }


        if ($user->primary_sales_target != $request->primarySalesTarget) {
            $user->primary_sales_target = $request->primarySalesTarget;
        }

        if ($user->secondary_sales_target != $request->secondarySalesTarget) {
            $user->secondary_sales_target = $request->secondarySalesTarget;
        }

        if ($user->available_leaves != $request->availableLeaves) {
            $user->available_leaves = $request->availableLeaves;
        }

        $user->save();

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }

    public function store(Request $request)
    {
        $rules = [
            'userName' => 'required|unique:users,user_name|min:6',
            'useDefaultPassword' => 'required',
            'email' => 'email|unique:users,email',
            'phoneNumber' => 'required|unique:users,phone_number',
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'parentId' => 'required',
            'shiftId' => 'required',
            'teamId' => 'required',
            'designation' => 'required',
            'attendanceType' => 'required'
        ];

        $customMessages = [
            'parentId.required' => 'Manager is required',
            'shiftId.required' => 'Shift is required',
            'teamId.required' => 'Team is required',
        ];


        $this->validate(request(), $rules, $customMessages);

        $settings = Settings::first();

        $attendanceType = 'none';

        if ($request->attendanceType == '1') {
            if (!$settings->is_geofence_attendance_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'Geofence attendance module is not available!');
            }

            if ($request->geofenceGroupId == null || $request->geofenceGroupId == 0) {
                return redirect()->route('employee.create')->with('error', 'Geofence group is required!');
            }

            $attendanceType = 'geofence';
        }

        if ($request->attendanceType == '2') {
            if (!$settings->is_ip_attendance_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'IP attendance module is not available!');
            }

            if ($request->ipGroupId == null || $request->ipGroupId == 0) {
                return redirect()->route('employee.create')->with('error', 'IP group is required!');
            }

            $attendanceType = 'ip_address';
        }

        if ($request->attendanceType == '3') {
            if (!$settings->is_qr_attendance_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'QR attendance module is not available!');
            }

            if ($request->qrGroupId == null || $request->qrGroupId == 0) {
                return redirect()->route('employee.create')->with('error', 'QR code group is required!');
            }
            $attendanceType = 'static_qr_code';
        }

        if ($request->attendanceType == '5') {
            if (!$settings->is_site_module_enabled) {
                return redirect()->route('employee.create')->with('error', 'Site attendance module is not available!');
            }

            if ($request->siteId == null || $request->siteId == 0) {
                return redirect()->route('employee.create')->with('error', 'Site is required!');
            }

            $attendanceType = 'site';
        }

        /*
               if ($request->attendanceType == '4') {
                    if (!$settings->is_dynamic_qr_attendance_module_enabled) {
                        return redirect()->route('employee.create')->with('error', 'Dynamic QR attendance module is not available!');
                    }

                    if ($request->dynamicQrId == null || $request->dynamicQrId == 0) {
                        return redirect()->route('employee.create')->with('error', 'Dynamic QR code group is required!');
                    }
                    $attendanceType = 'dynamic_qr_code';
                }

               */


        $newUser = array(
            'user_name' => $request->userName,
            'password' => Hash::make($request->useDefaultPassword == null ? $request->password : "123456"),
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,

            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'unique_id' => $request->uniqueId,
            'alternate_number' => $request->alternateNumber,
            'address' => $request->address,

            'parent_id' => $request->parentId,
            'shift_id' => $request->shiftId,
            'team_id' => $request->teamId,
            'date_of_joining' => $request->dateOfJoining,
            'designation' => $request->designation,
            'base_salary' => $request->baseSalary,
            'primary_sales_target' => $request->primarySalesTarget,
            'secondary_sales_target' => $request->secondarySalesTarget,
            'available_leaves' => $request->availableLeaves,
            'attendance_type' => $attendanceType,
            'geofence_group_id' => $attendanceType == 'geofence' ? $request->geofenceGroupId : null,
            'ip_address_group_id' => $attendanceType == 'ip_address' ? $request->ipGroupId : null,
            'qr_code_group_id' => $attendanceType == 'static_qr_code' ? $request->qrGroupId : null,
            'site_id' => $attendanceType == 'site' ? $request->siteId : null,
            /* 'dynamic_qr_id' => $attendanceType == 'dynamic_qr_code' ? $request->dynamicQrId : null,
             */
        );

        $user = User::create($newUser);


        $userRole = Sentinel::findRoleBySlug('user');

        $userRole->users()->attach($user);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    public function destroy($id)
    {
        if (env('DEMO_MODE')) {
            return redirect()->route('account.show', ['id' => $id])->with('error', 'You can not change status in demo mode');
        }
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->route('employee.index');
    }

    public function changeStatus(Request $request)
    {
        if (env('DEMO_MODE')) {
            return redirect()->route('employee.show', ['id' => $request->id])->with('error', 'You can not change status in demo mode');
        }
        $employee = User::findOrFail($request->id);
        if ($employee->status == 'active') {
            $employee->status = 'inactive';
        } else {
            $employee->status = 'active';
        }
        $employee->save();

        return redirect()->route('employee.show', $request->id)->with('success', 'Employee status changed successfully');
    }

    public function getGeofenceGroups()
    {
        $geofenceGroups = GeofenceGroup::where('status', '=', 'active')
            ->select('id', 'name')
            ->get();

        return response()->json($geofenceGroups);
    }

    public function getIpGroups()
    {
        $ipGroups = IpAddressGroup::where('status', '=', 'active')
            ->select('id', 'name')
            ->get();

        return response()->json($ipGroups);
    }

    public function getQrGroups()
    {
        $qrGroups = QRCodeGroup::where('status', '=', 'active')
            ->select('id', 'name')
            ->get();

        return response()->json($qrGroups);
    }

    public function getSites()
    {
        $sites = Site::where('status', '=', 'active')
            ->select('id', 'name')
            ->get();

        return response()->json($sites);
    }


}
