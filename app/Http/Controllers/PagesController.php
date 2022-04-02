<?php

namespace App\Http\Controllers;

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
        // Get view file location from menu config
        $view = theme()->getOption('page', 'view');

        $isManager = 0;
      
        if(auth()->user()->can('view report')){
            $isManager = 1;
        }

        $officer = $this->officerPerformance($isManager);
        $month = $this->chart_month($isManager);
        $performance = $this->userPerformance($isManager);

        $roles = auth()->user()->getRoleNames()->toArray();
        // Check if the page view file exist
        if (view()->exists('pages.'.$view)) {            
            // if(intval(auth()->user()->user_type ) == 3)
            if(in_array('client', $roles))
                return redirect('admin/home');
            elseif(in_array('staff', $roles))
                return redirect('admin/token/current');
            else
                return view('pages.'.$view,  compact('month', 'performance', 'officer'));

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
     public function chart_month($isManager)
     {  
        $sql = " AND t.user_id = '". auth()->user()->id  ."'";
        $sql = ($isManager == 0) ? $sql : "";
        
        return DB::select(DB::raw("
         SELECT 
            DATE_FORMAT(created_at, '%b') AS date,
            COUNT(CASE WHEN status = 1 THEN 1 END) as success,
            COUNT(CASE WHEN status = 2 THEN 1 END) as cancel,
            COUNT(t.id) AS total
        FROM 
            token AS t
        WHERE  
            YEAR(created_at) >= YEAR(CURRENT_DATE())".$sql." 
        GROUP BY 
            date
        ORDER BY 
         t.created_at ASC
         "));
     }

     public function userPerformance($isManager)
    { 
        $managerArr = array('isManager' => $isManager);
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
        ->leftJoin("department as d", function($join){
            $join->on("u.department_id", "=", "d.id");
        })
        ->leftJoin("token AS t", function($join) {
            $join->on("t.user_id", "=", "u.id");
            // $join->whereDate("t.created_at", "=", date("Y-m-d"));
        })
        ->when($managerArr, function ($query, $manager) {
            if($manager['isManager'] == 0)
                return $query->where('u.id', auth()->user()->id);
            else{
                return $query->whereNotNull('d.name')->whereIn('u.user_type', [1]);
            }
        })
        ->groupBy("u.id")
        ->get();
       
        return $query;
    } 

    // user performance
    public function officerPerformance($isManager)
    {
        $managerArr = array('isManager' => $isManager);
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
            ->leftJoin("token AS t", function($join) {
                $join->on("t.user_id", "=", "u.id");
                // $join->whereDate("t.created_at", "=", date("Y-m-d"));
            })
            ->when($managerArr, function($query, $manager){
                 if($manager['isManager'] == 0)
                    return $query->where('u.id', auth()->user()->id)->groupBy("t.user_id");
            })
            
            ->first(); 

            return $query;
    } 

    
}
