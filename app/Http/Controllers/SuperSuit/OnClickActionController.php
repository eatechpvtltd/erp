<?php

/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\SuperSuit;

use App\Http\Controllers\CollegeBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Image, URL;
use OwenIt\Auditing\Models\Audit;
use ViewHelper;

class OnClickActionController extends CollegeBaseController
{
    protected $base_route = 'super-suit.cleaner';
    protected $view_path = 'super-suit.cleaner';
    protected $panel = 'One Click Clean';
    protected $filter_query = [];

    public function __construct()
    {
    }

    public function cleaner(Request $request)
    {
        request()->session()->flash("message_danger", "Be Careful, While Cleaning. It May Delete Your Valuable Records. Backup Your Data Base First.");
        return view(parent::loadDataToView($this->view_path.'.index')/*, compact('data')*/);

    }

    public function clearAllCache(Request $request)
    {
        Cache::flush();
        request()->session()->flash("message_success", "Cache Clear Now.");
        return back();
    }

    public function cacheClear(Request $request)
    {
        Artisan::call('cache:clear');
        request()->session()->flash("message_success", "Cache Cache Clean Successfully.");
        return back();
    }
    public function routeClear(Request $request)
    {
        Artisan::call('route:clear');
        request()->session()->flash("message_success", "Route Cache Clean Successfully.");
        return back();
    }
    public function configClear(Request $request)
    {
        Artisan::call('config:clear');
        request()->session()->flash("message_success", "Configuration Cache Clean Successfully.");
        return back();
    }
    public function viewClear(Request $request)
    {
        Artisan::call('view:clear');
        request()->session()->flash("message_success", "View Cache Clean Successfully.");
        return back();
    }


    public function clearUserActivity(Request $request)
    {
        Audit::truncate();
        request()->session()->flash("message_success", "User History/Log Clean Successfully.");
        return back();
    }

}
