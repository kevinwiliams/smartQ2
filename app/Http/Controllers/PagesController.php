<?php

namespace App\Http\Controllers;

use App\Core\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $key_value = auth()->user()->getSettingByKey(Constants::User_Settings_Onboarding);

        // echo $key_value;
        // die();
        if ($key_value != null) {
            if ($key_value != Constants::Onboarding_Total_Step_Count + 1)                
                return redirect("/onboarding");
        }
        
        // Get view file location from menu config
        $view = theme()->getOption('page', 'view');




        $roles = auth()->user()->getRoleNames()->toArray();

        $dmode = (theme()->isDarkMode()) ? '?mode=dark' : '';
        // Check if the page view file exist
        if (view()->exists('pages.' . $view)) {
            // if(intval(auth()->user()->user_type ) == 3)
            if (in_array('client', $roles))
                return redirect('home' . $dmode);
            elseif (in_array('staff', $roles))
                return redirect('token/current' . $dmode);
            else {
                $officer = $this->officerPerformance();
                $month = $this->chart_month();
                $performance = $this->userPerformance();
                $daily = $this->dailyPerformance();

                return view('pages.' . $view,  compact('month', 'performance', 'officer', 'daily'));
            }
        }
        // Get the default inner page
        return view('inner');
    }

    /**
     * Temporary function to replace icon duotone
     */
    public function replaceIcons()
    {
        $fileContent = file_get_contents(public_path('icon_replacement.txt'));
        $lines       = explode("\n", $fileContent);

        $patterns     = [];
        $replacements = [];
        foreach ($lines as $line) {
            $el             = explode(' - ', $line);
            $patterns[]     = trim($el[0]);
            $replacements[] = trim($el[1]);
        }

        $files    = File::allFiles(resource_path());
        $filtered = array_filter($files, function ($str) {
            return strpos($str, ".php") !== false;
        });

        foreach ($filtered as $file) {
            $bladeFileContent = file_get_contents($file->getPathname());

            $bladeFileContent = str_replace($patterns, $replacements, $bladeFileContent);

            file_put_contents($file->getPathname(), $bladeFileContent);
        }
    }

    //chart month wise token
    public function chart_month()
    {
        $roles = auth()->user()->getRoleNames()->toArray();
        if (in_array('officer', $roles))
            $sql = " AND t.user_id = '" . auth()->user()->id  . "'";
        else
            $sql = "";


        return DB::select(DB::raw("
         SELECT 
            DATE_FORMAT(created_at, '%b') AS date,
            COUNT(CASE WHEN status = 1 THEN 1 END) as success,
            COUNT(CASE WHEN status = 2 THEN 1 END) as cancel,
            COUNT(t.id) AS total
        FROM 
            token AS t
        WHERE  
            YEAR(created_at) >= YEAR(CURRENT_DATE())" . $sql . " 
        GROUP BY 
            date
        ORDER BY 
         t.created_at ASC
         "));
    }

    public function userPerformance()
    {
        $roles = auth()->user()->getRoleNames()->toArray();
        $location = auth()->user()->location_id;
        $query = DB::table("user AS u")
            ->select(DB::raw("
            u.id,
            CONCAT_WS(' ', u.firstname, u.lastname) AS username,
            d.name AS department,
            u.photo,
            COUNT(CASE WHEN t.status='0' THEN t.id END) AS pending,
            COUNT(CASE WHEN t.status='1' THEN t.id END) AS complete,
            COUNT(CASE WHEN t.status='2' THEN t.id END) AS stop,
            COUNT(t.id) AS total 
        "))
            ->where('u.location_id', $location)
            ->leftJoin("department as d", function ($join) {
                $join->on("u.department_id", "=", "d.id");
            })
            ->leftJoin("token AS t", function ($join) {
                $join->on("t.user_id", "=", "u.id");
                // $join->whereDate("t.created_at", "=", date("Y-m-d"));
            })
            ->when($roles, function ($query, $role) {
                if (in_array('officer', $role))
                    return $query->where('u.id', auth()->user()->id);
                else
                    return $query->whereNotNull('d.name')->whereIn('u.user_type', [1]);
            })
            ->groupBy("u.id")
            ->get();

        $officers = $query->pluck('id');

        $users = User::whereIn('id', $officers)->get();
        // $test = $users->firstWhere('id', 1);
        // echo '<pre>';
        // print_r($test);
        // echo '</pre>';
        // die();

        foreach ($query as $value) {
            $officer = $users->firstWhere('id', $value->id);
            if ($officer)
                $value->avg = ($officer->stats) ? $officer->stats->wait_time : '-';
            else
                $value->avg = "-";
        }
        // echo '<pre>';
        // print_r($query->sum('total'));
        // echo '</pre>';
        // die();


        return $query;
    }

    // user performance
    public function officerPerformance()
    {
        $roles = auth()->user()->getRoleNames()->toArray();
        $location = auth()->user()->location_id;
        $query = DB::table("user AS u")
            ->select(DB::raw("
                u.id,
                CONCAT_WS(' ', u.firstname) AS username,
                u.user_type,
                COUNT(CASE WHEN t.status='0' THEN t.id END) AS pending,
                COUNT(CASE WHEN t.status='1' THEN t.id END) AS complete,
                COUNT(CASE WHEN t.status='2' THEN t.id END) AS stop,
                COUNT(CASE WHEN t.status='3' THEN t.id END) AS booked,
                COUNT(t.id) AS total 
            "))
            ->where('u.location_id', $location)
            ->leftJoin("token AS t", function ($join) {
                $join->on("t.user_id", "=", "u.id");
                // $join->whereDate("t.created_at", "=", date("Y-m-d"));
            })
            ->when($roles, function ($query, $role) {
                if (in_array('officer', $role))
                    return $query->where('u.id', auth()->user()->id)->groupBy("t.user_id");
            })

            ->first();

        return $query;
    }


    public function dailyPerformance()
    {
        $days     = [0, 1, 2, 3, 4, 5, 6];
        $dayNames = array(
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        );

        $data = DB::table("token")
            ->select(DB::raw("            
            COUNT(token.`created_at`) AS 'total',                         
            WEEKDAY(token.`created_at`) AS 'day',
            DAYNAME(token.`created_at`) AS 'dayname'"))
            ->where('location_id', auth()->user()->location_id)
            ->groupByRaw('WEEKDAY(token.`created_at`)')
            ->orderByRaw('day')
            ->get();

        $sumtotal = DB::table("token")
            ->select(DB::raw("            
            COUNT(token.`created_at`) AS 'total'"))
            ->where('location_id', auth()->user()->location_id)
            ->pluck('total')->first();

        if (count($data) < 7) {
            foreach ($days as $_day) {
                $info = $data->firstWhere('day', $_day);
                if (!$info) {
                    $dataObj = ["total" => 0, "day" => $_day, "dayname" => $dayNames[$_day]];
                    $data[count($data)] = (object)$dataObj;
                }
            }

            $newdata = [];
            foreach ($days as $_day) {
                $info = $data->firstWhere('day', $_day);
                $newdata[$_day] = $data->firstWhere('day', $_day);
            }

            $data = $newdata;
        }

        foreach ($data as $_dataitem) {
            if ($sumtotal == 0)
                $_dataitem->percentage = 0;
            else
                $_dataitem->percentage = round(($_dataitem->total / $sumtotal) * 100, 2);
        }

        return $data;
    }
}
