<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use Scaffolding\Traits\ScaffoldingTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Status;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    use ScaffoldingTrait;
    public function _vars()
    {
        return [
            'status' => Status::pluck('name','id'),
        ];
    }

    public function __construct()
    {
        $prefix = 'kelas';
        $title = 'kelas';
        $model = new Kelas();
        $this->setConfig([
            'model' => $model,
            'prefix' => $prefix,
            'title' => $title
        ]);
        $this->scaffolding()->datatableSet([
            'checkbox' => false,
            'timestamp' => false,
            'dom' => '<"top display-flex">lrt<"bottom"p>',
            'viewToolbar' => view('scaffolding::index-toolbar'),
            'lengthMenu' => [10, 30, 50, 100, 200],
            'order' => [0, 'asc'],
            'actions' => ['edit', 'view'],
            'withQuery' => Kelas::select([
                'kelas.*',
                'aa.name',
                'class'
               
            ])
                ->leftJoin('statuses as aa', 'aa.id','=','kelas.status_id')
        ])
            ->datatableColumnUnset([], true)
            ->datatableColumnSet([
                'id' => [
                    'title' => 'ID',
                    'searchPlaceHolder' => '',
                ],
                'nama_kelas' => [
                    'title' => 'Nama',
                    'searchPlaceHolder' => '',
                ],
                'status_id' => [
                    'title' => 'status',
                    'searchable' => true,
                    'searchType' => 'select',
                    'formatter' => function($model){
                        return '<span class="'.$model->class.'">'.$model->name.'</span>';
                    },
                    'searchOptions' => function() {
                        return Status::pluck('name', 'id')->prepend(__('All'), '');
                    }
                ],
            ]);
    }

    public function create(KelasRequest $request) 
    {
        extract($this->_vars());
        if($request->isMethod('put')) return $this->save($request);
        return view('pages.kelas.create',get_defined_vars());
    }

    public function edit(KelasRequest $request, $id)
    {
        extract($this->_vars());
        if($request->isMethod('patch')) return $this->save($request, $id);
        $model = Kelas::findOrFail($id);
        return view('pages.kelas.edit',get_defined_vars());
    }

    public function save(KelasRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $model = $id ? Kelas::findOrFail($id) : new Kelas();
            $model->fill($request->all());
            $model->save();
            DB::commit();
            
            return $request->ajax() ? response([
                'message' => 'Data saved',
                'redirect' => route('kelas.index'),
                'data' => $model,
            ]) : redirect(route('kelas.index'))->with('success', 'Data saved!');
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
        }
    }
    // public function view($id)
    // {
    //     $model = User::query()
    //     ->select('users.*','bb.name as role_name')
    //     ->leftJoin('model_has_roles as aa','aa.model_id','=','users.id')
    //     ->leftJoin('roles as bb','bb.id','=','aa.role_id')
    //     ->where('users.id',$id)->first();

    //     // dd($model);
    //     return view('pages.user.view', get_defined_vars());
    // }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
