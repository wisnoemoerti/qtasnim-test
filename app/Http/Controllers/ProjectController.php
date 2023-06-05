<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

use App\Models\TbMProject;
use App\Models\TbMClient;
use Carbon\Carbon;
class ProjectController extends Controller
{

    public function index()
    {
        $client = TbMClient::all();
        
        return view('pages.projects')->with(['client'=>$client]);
    }
    public function datatables(Request $request)
    {
        $table = DB::table('tb_m_projects')
            ->join('tb_m_clients', 'tb_m_projects.client_id', '=', 'tb_m_clients.client_id')
            ->select('tb_m_projects.*', 'tb_m_clients.client_name')
            ->orderBy('created_at','desc');
        
        if($request->project_filter){
            $table->where('tb_m_projects.project_name', 'like', '%'.$request->project_filter.'%');
        }
        if($request->client_filter){
            $table->where('tb_m_projects.client_id','=',$request->client_filter);
        }
        if($request->project_status_filter){
            $table->where('tb_m_projects.project_status','=',$request->project_status_filter);
        }
            
        $datatable = Datatables::of($table);
        $datatable->addIndexColumn();
        $datatable->addColumn('checkbox', function($value) {
            $template = '
                <input class="form-control custom-check" type="checkbox" name="id" value="'.$value->project_id.'" />
            ';
            return $template;
            });
        $datatable->addColumn('actions', function($value) {
            $template = '
            <a href="javascript:void(0);" class="btn btn-info btn-icon-split mr-2" id="update" 
            data-id="'.$value->project_id.'"
            data-name="'.$value->project_name.'"
            data-start="'.$value->project_start.'"
            data-end="'.$value->project_end.'"
            data-client="'.$value->client_id.'"
            data-status="'.$value->project_status.'"
            >
                <span class="icon text-white-50">
                    <i class="fas fa-pen fa-sm"></i>
                </span>
                <span class="text">Update</span>
            </a>
            ';
            return $template;
            });
            $datatable->editColumn('project_start', function($value) {
                return  Carbon::parse($value->project_start)->format('d M Y');
            });

            $datatable->editColumn('project_end', function($value) {
                return  Carbon::parse($value->project_end)->format('d M Y');
            });
            
        $datatable->rawColumns(['actions','checkbox']);
        return $datatable->make(true);
    } 

    public function crud(Request $request){
        if ($request->isMethod('post')) {
            if($request->project_id !== null) {
                return TbMProject::updateData($request);
            }else {
                return TbMProject::createData($request);    
            }
        }
        else if ($request->isMethod('delete')) {
            return TbMProject::deleteData($request);
        }
    }

}
