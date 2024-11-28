<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $fillable = [
        'app_name',
        'app_version',
        'country',
        'phone_country_code',
        'timezone',
        'currency',
        'currency_symbol',
        'distance_unit',
        'offline_check_time_type',
        'offline_check_time',
        'm_app_version',
        'm_location_update_time_type',
        'm_location_update_interval',
        'privacy_policy_url',
        'map_provider',
        'map_zoom_level',
        'center_latitude',
        'center_longitude',
        'created_by_id',
        'updated_by_id',
        'is_product_order_module_enabled',
        'is_task_module_enabled',
        'is_notice_module_enabled',
        'is_dynamic_form_module_enabled',
        'is_expense_module_enabled',
        'is_leave_module_enabled',
        'is_document_module_enabled',
        'is_chat_module_enabled',
        'is_loan_module_enabled',
        'is_payment_collection_module_enabled',
        'is_geofence_attendance_module_enabled',
        'is_ip_attendance_module_enabled',
        'is_uid_login_module_enabled',
        'is_client_visit_module_enabled',
        'is_offline_tracking_module_enabled',
        'is_data_import_export_module_enabled',
        'is_site_module_enabled',
        'is_qr_attendance_module_enabled',
        'is_dynamic_qr_attendance_module_enabled',
        'is_break_module_enabled',
        'is_sales_target_module_enabled',
        'is_ai_chat_module_enabled',
        'is_audit_log_enabled',
        'employee_code_prefix',
        'order_prefix',
        'verify_client_number',
        'is_biometric_verification_module_enabled'
    ];

    protected $casts = [
        'offline_check_time' => 'integer',
        'm_location_update_interval' => 'integer',
        'map_zoom_level' => 'integer',
        'center_latitude' => 'decimal:10',
        'center_longitude' => 'decimal:11',
        'is_ai_chat_enabled' => 'boolean',
        'is_product_order_module_enabled' => 'boolean',
        'is_task_module_enabled' => 'boolean',
        'is_notice_module_enabled' => 'boolean',
        'is_dynamic_form_module_enabled' => 'boolean',
        'is_expense_module_enabled' => 'boolean',
        'is_leave_module_enabled' => 'boolean',
        'is_document_module_enabled' => 'boolean',
        'is_chat_module_enabled' => 'boolean',
        'is_loan_module_enabled' => 'boolean',
        'is_payment_collection_module_enabled' => 'boolean',
        'is_geofence_attendance_module_enabled' => 'boolean',
        'is_ip_attendance_module_enabled' => 'boolean',
        'is_uid_login_module_enabled' => 'boolean',
        'is_client_visit_module_enabled' => 'boolean',
        'is_offline_tracking_module_enabled' => 'boolean',
        'is_data_import_export_module_enabled' => 'boolean',
        'is_site_module_enabled' => 'boolean',
        'is_qr_attendance_module_enabled' => 'boolean',
        'is_dynamic_qr_attendance_enabled' => 'boolean',
        'is_break_module_enabled' => 'boolean',
        'is_sales_target_module_enabled' => 'boolean',
        'is_ai_chat_module_enabled' => 'boolean',
        'is_audit_log_enabled' => 'boolean',
    ];

}
