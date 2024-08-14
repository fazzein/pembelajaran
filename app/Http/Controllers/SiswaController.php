<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\SiswaRequest;
use App\Models\User;
use Scaffolding\Traits\ScaffoldingTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    use ScaffoldingTrait;

    public function __construct()
    {
        $prefix = 'siswa';
        $title = 'Siswa';
        $model = new Siswa();
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
            'actions' => ['edit', 'view']
        ])
            ->datatableColumnUnset([], true)
            ->datatableColumnSet([
                'id' => [
                    'title' => 'ID',
                    'searchPlaceHolder' => '',
                ],
                'nama_siswa' => [
                    'title' => 'Nama',
                    'searchPlaceHolder' => '',
                ],
                'nis' => [
                    'title' => 'NIS',
                    'searchPlaceHolder' => '',
                ],
                'tempat_lahir' => [
                    'title' => 'Tempat Lahir',
                    'searchPlaceHolder' => '',
                ],
                'tanggal_lahir' => [
                    'title' => 'Tanggal Lahir',
                    'searchPlaceHolder' => '',
                ],
                'telepon' => [
                    'title' => 'Telepon',
                    'searchPlaceHolder' => '',
                ],
                'kelas_id' => [
                    'title' => 'Kelas',
                    'searchPlaceHolder' => '',
                ],
            ]);
    }

    public function create(SiswaRequest $request)
    {
        if ($request->method() == 'PUT') return $this->save($request);
        return view('pages.siswa.create', get_defined_vars());
    }

    public function edit(SiswaRequest $request, $id)
    {
        $model = Siswa::findOrFail($id);
        if ($request->method() == 'PATCH') return $this->save($request, $id);
        return view('pages.siswa.edit', get_defined_vars());
    }

    public function view($id)
    {
        $model = Siswa::findOrFail($id);
        return view('pages.siswa.view', get_defined_vars());
    }

    public function save(SiswaRequest $request, $id = null)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $model = $id ? Siswa::findOrFail($id) : new Siswa();
            $model->fill($request->all());
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('public/photos/siswa');
                $model->photo = basename($photoPath);
            }
            $model->save();
            DB::commit();
            return $request->ajax() ? response([
                'message' => 'Data disimpan',
                'redirect' => route('siswa.index'),
                'data' => $model,
            ]) : redirect(route('siswa.index'))->with('success', 'Data Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            DB::commit();
            return redirect()->route('siswa.index')->with('success', 'Siswa and associated user successfully deleted.');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('siswa.index')->with('error', 'An error occurred while deleting the records.');
        }
    }
}
