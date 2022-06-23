<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'LoginController/login2';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// login
$route['login'] = 'LoginController/login';
$route['login2'] = 'LoginController/login2';
$route['validate_login'] = 'LoginController/validate_login';
// About
$route['About'] = 'AdminController/About';

// Admin
$route['dashboard_index'] = 'AdminController/dashboard_index';
$route['LogOut'] = 'AdminController/LogOut';
$route['user_setup_admin'] = 'AdminController/user_setup_admin';
$route['location_setup_admin'] = 'AdminController/location_setup_admin';
$route['add_location_admin'] = 'AdminController/add_location_admin';
$route['getEmpNames_usersetup_admin'] = 'AdminController/getEmpNames_usersetup_admin';
$route['save_user_admin'] = 'AdminController/save_user_admin';
$route['getUserlist_tbl_admin'] = 'AdminController/getUserlist_tbl_admin';
$route['update_user_stat_admin'] = 'AdminController/update_user_stat_admin';
$route['getuser_info_admin'] = 'AdminController/getuser_info_admin';
$route['billing_statement_page'] = 'AdminController/billing_statement';
$route['collection_page'] = 'AdminController/collection';
$route['coupon_list_page'] = 'AdminController/coupon_list';
$route['ticket_list_page'] = 'AdminController/ticket_list';
$route['overall_collection_page'] = 'AdminController/overall_collection';
$route['syncData'] = 'AdminController/syncs';
$route['vehicle_monitoring_page'] = 'AdminController/vehicle_monitoring';
$route['change_username'] = 'AdminController/change_username';
$route['change_password'] = 'AdminController/change_password';
$route['getLocationData'] = 'AdminController/getLocationData';
$route['location_datas_by_dt'] = 'AdminController/location_datas_by_dt';
// $route['profile_change'] = 'AdminController/profile_change';
$route['save_user_pp'] = 'AdminController/save_user_pp';
$route['parking_log_page'] = 'AdminController/parking_log';
$route['edit_location_admin'] = 'AdminController/edit_location_admin';
$route['activate_location_admin'] = 'AdminController/activate_location_admin';
$route['get_emp_location/(:any)'] = 'AdminController/get_emp_location';
$route['set_emp_location/(:any)'] = 'AdminController/set_emp_location';
$route['SetupUserLocationz'] = 'AdminController/SetupUserLocationz';
$route['delete_loc_user'] = 'AdminController/delete_loc_user';
$route['save_user_adminv2'] = 'AdminController/save_user_adminv2';
$route['get_daily_trans'] = 'AdminController/get_daily_trans';
$route['get_daily_trans_2/(:any)/(:any)'] = 'AdminController/get_daily_trans_2';
$route['get_ticket_list_data'] = 'AdminController/get_ticket_list_data';
$route['get_coupon_list_data'] = 'AdminController/get_coupon_list_data';
$route['get_blacklist_data/(:any)/(:any)'] = 'AdminController/get_blacklist_data'; //Black List
$route['get_v_monitoring_list_data'] = 'AdminController/get_v_monitoring_list_data';
$route['genTicketDataByList/(:any)/(:any)'] = 'AdminController/genTicketDataByList';
$route['genCouponDataByList/(:any)/(:any)'] = 'AdminController/genCouponDataByList';
$route['gen_v_monitoring_data/(:any)/(:any)'] = 'AdminController/gen_v_monitoring_data';
$route['get_billing_statement_data'] = 'AdminController/get_billing_statement_data';
$route['get_billing_statement_datavs2/(:any)/(:any)'] = 'AdminController/get_billing_statement_datavs2';
$route['get_collection_list_data'] = 'AdminController/get_collection_list_data';
$route['get_collection_list_datavs2/(:any)/(:any)'] = 'AdminController/get_collection_list_datavs2';
$route['get_overallcollection_list_data'] = 'AdminController/get_overallcollection_list_data';
$route['get_overallcollection_list_datavs2/(:any)/(:any)'] = 'AdminController/get_overallcollection_list_datavs2';
$route['get_data_for_pie_chart'] = 'AdminController/get_data_for_pie_chart';
$route['get_alldata_for_wedget'] = 'AdminController/get_alldata_for_wedget';
$route['all_users_views'] = 'AdminController/all_users_views';
$route['sample_data'] = 'AdminController/sample_data';
$route['getThePreviewsData'] = 'AdminController/getThePreviewsData';
$route['getNumOfWeeklyData'] = 'AdminController/getNumOfWeeklyData';
// report #2
$route['end_of_shift_report'] = 'AdminController/end_of_shift_report';
$route['end_of_day_report'] = 'AdminController/end_of_day_report';

$route['monthly_data_report'] = 'AdminController/ReportMonthlyData';
$route['monthly_range_data_report'] = 'AdminController/ReportRangeMonthlyData';


				/*jay route*/
$route['get_blacklisted_route'] = 'AdminController/get_blacklisted_adminctrl';
$route['unblock_route'] = 'AdminController/unblock_adminctrl';
$route['admin_unblock_route'] = 'AdminController/admin_unblock_report_ctrl';
$route['loginlogout_history_route'] = 'AdminController/loginlogout_history_ctrl';
$route['get_unblock_data_route/(:any)/(:any)'] = 'AdminController/get_unblock_data_ctrl';
$route['get_loginlogout_data_route/(:any)/(:any)'] = 'AdminController/get_loginlogout_data_ctrl';
$route['getprint_unblockdata_route'] = 'AdminController/getprint_unblockdata_ctrl';
$route['getprint_loginlogout_route'] = 'AdminController/getprint_loginlogout_ctrl';
$route['count_unblocklist_route'] = 'AdminController/count_unblocklist_ctrl';
$route['count_loginlogoutlist_route'] = 'AdminController/count_loginlogoutlist_ctrl';
$route['remittance_route'] = 'AdminController/remittance_ctrl';
$route['display_incharge_remittance_route'] = 'AdminController/display_remittance_incharge_ctrl';
$route['get_incharge_remittance_route'] = 'AdminController/get_remittance_incharge_ctrl';
$route['save_remittance_route'] = 'AdminController/save_remittance_ctrl';
$route['generate_texfile_route/(:any)/(:any)'] = 'AdminController/generate_texfile_ctrl';
$route['generate_unblocktexfile_route/(:any)/(:any)'] = 'AdminController/generate_unblocktexfile_ctrl';


$route['pdf_print_route'] = 'ReportViewController/pdf_print_ctrl';
				/*end jay route*/

$route['daily_statistics_report'] = 'AdminController/daily_statistics_report';
$route['weekly_statistics_report'] = 'AdminController/weekly_statistics_report';
$route['monthly_statistics_report'] = 'AdminController/monthly_statistics_report';
$route['black_listed_report'] = 'AdminController/black_listed_report';
$route['get_incharge_collection_list/(:any)/(:any)/(:any)'] = 'AdminController/get_incharge_collection_list';
$route['get_EndOfShift_by_incharge'] = 'AdminController/get_EndOfShift_by_incharge';
$route['search_endofshift_data'] = 'AdminController/search_endofshift_data';
$route['get_months_data'] = 'AdminController/get_months_data';
$route['get_days_data'] = 'AdminController/get_days_data';
$route['get_years_data'] = 'AdminController/get_years_data';
$route['get_end_of_day_data'] = 'AdminController/get_end_of_day_data';
$route['getendofdaydata/(:any)/(:any)'] = 'AdminController/getendofdaydata';
$route['get_weekly_stat_data'] = 'AdminController/get_weekly_stat_data';
$route['get_WeeklyStatData/(:any)/(:any)'] = 'AdminController/get_WeeklyStatData';
$route['get_monthly_byMonth_data/(:any)'] = 'AdminController/get_monthly_byMonth_data';
$route['get_monthly_data/(:any)'] = 'AdminController/get_monthly_data';
$route['get_num_data_byMonth'] = 'AdminController/get_num_data_byMonth';
$route['get_numdata_by_month'] = 'AdminController/get_numdata_by_month';
$route['count_blacklisted_list'] = 'AdminController/count_blacklisted_list';
$route['get_blacklist_data_list'] = 'AdminController/get_blacklist_data_list';
// report view pages
$route['report_incharge_endofshift/(:any)/(:any)'] = 'ReportViewController/report_incharge_endofshift';
$route['report_incharge_endofday/(:any)/(:any)'] = 'ReportViewController/report_incharge_endofday';
$route['report_incharge_daily/(:any)/(:any)'] = 'ReportViewController/report_incharge_daily';
$route['report_incharge_weekly/(:any)/(:any)'] = 'ReportViewController/report_incharge_weekly';
$route['report_incharge_monthly/(:any)/(:any)'] = 'ReportViewController/report_incharge_monthly';
$route['report_snyc_monthly_data/(:any)/(:any)'] = 'ReportViewController/report_snyc_monthly_data';
// $route['report_MonthlyRangeData/(:any)'] = 'ReportViewController/report_MonthlyRangeData';
$route['report_MonthlyRangeData/(:any)/(:any)'] = 'ReportViewController/report_MonthlyRangeData';
//pj routes
$route['sync_data'] = 'AppController/appSync_ctrl';
$route['app_login'] = 'AppController/appLogin_ctrl';
$route['app_getUserData'] = 'AppController/getUserData_ctrl';
$route['olSaveTransaction'] = 'AppController/olSaveTransaction_ctrl';
$route['appGetTransaction'] = 'AppController/appGetTransaction_ctrl';
$route['appSaveToHistory'] = 'AppController/appSaveToHistory_ctrl';
$route['appUpdateTrans'] = 'AppController/appUpdateTrans_ctrl';
$route['trapLocation'] = 'AppController/trapLocation_ctrl';
$route['olFetchSearch'] = 'AppController/olFetchSearch_ctrl';
$route['olFetchSearchHistory'] = 'AppController/olFetchSearchHistory_ctrl';
$route['olSaveDelinquent'] = 'AppController/olSaveDelinquent_ctrl';
$route['olManagerKey'] = 'AppController/olManagerKey_ctrl';
$route['olSendTransType'] = 'AppController/olSendTransType_ctrl';
$route['olReprintCouponTicket'] = 'AppController/olReprintCouponTicket_ctrl';
$route['olCancel'] = 'AppController/olCancel_ctrl';
$route['olFetchHistory'] = 'AppController/olFetchHistory_ctrl';
$route['olPenaltyReprint'] = 'AppController/olPenaltyReprint_ctrl';

$route['app_countDataDownload'] = 'AppController/app_countDataDownload_ctrl';
$route['app_countLocationUser'] = 'AppController/app_countLocationUser_ctrl';
$route['app_countLocation'] = 'AppController/app_countLocation_ctrl';

$route['app_downLoadUser'] = 'AppController/app_downLoadUser_ctrl';
$route['app_downLoadlocation_user'] = 'AppController/app_downLoadlocation_user_ctrl';
$route['app_downLoadlocation'] = 'AppController/app_downLoadlocation_ctrl';
$route['app_downloadDelinquent'] = 'AppController/app_downloadDelinquent_ctrl';
$route['app_countTblManager'] = 'AppController/app_countTblManager_ctrl';
$route['app_downLoadManager'] =  'AppController/app_downLoadManager_ctrl';
$route['app_countTblDelinquent'] = 'AppController/app_countTblDelinquent_ctrl';

//renan routes
$route['print_ticket'] = 'AppController2/print_ticket';
$route['print_penalty'] = 'AppController2/print_penalty';
$route['get_transaction_type'] = 'AppController2/get_transaction_type';
$route['reprint_ticket'] = 'AppController2/reprint_ticket';
$route['reprint_penalty'] = 'AppController2/reprint_penalty';

// mae routes
$route['app_downloadDelinquent2'] = 'AppController/app_downloadDelinquent_ctrl2'; 
$route['saveLogInData'] = 'AppController/saveLogInData_ctrl';
$route['saveLogOutData'] = 'AppController/saveLogOutData_ctrl'; 


