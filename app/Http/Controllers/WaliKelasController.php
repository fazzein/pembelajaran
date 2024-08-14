<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaliKelasRequest;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Status;
use App\Models\WaliKelas;
use Scaffolding\Traits\ScaffoldingTrait;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
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
        $prefix = 'wali_kelas';
        $title = 'wali_kelas';
        $model = new WaliKelas();
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

    public function create(WaliKelasRequest $request) 
    {
        extract($this->_vars());
        if($request->isMethod('put')) return $this->save($request);
        return view('pages.kelas.create',get_defined_vars());
    }

    public function edit(WaliKelasRequest $request, $id)
    {
        extract($this->_vars());
        if($request->isMethod('patch')) return $this->save($request, $id);
        $model = Kelas::findOrFail($id);
        return view('pages.kelas.edit',get_defined_vars());
    }

    public function save(WaliKelasRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $model = $id ? WaliKelas::findOrFail($id) : new WaliKelas();
            $model->fill($request->all());
            $model->save();
            DB::commit();            
            return $request->ajax() ? response([
                'message' => 'Data saved',
                'redirect' => route('wali.index'),
                'data' => $model,
            ]) : redirect(route('wali.index'))->with('success', 'Data saved!');
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
        }
    }
    public function view($id)
    {
        $model = WaliKelas::findOrFail($id);
        return view('pages.user.view', get_defined_vars());
    }

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
