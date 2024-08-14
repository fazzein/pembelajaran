<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        $rules = [];
        switch ($method) {
            case 'PUT': // For creating a new entry
                $rules = [
                    'nama_siswa' => 'required|string|max:255',
                    'nis' => 'required|string|max:255|unique:siswas',
                    'tempat_lahir' => 'required|string|max:255',
                    'tanggal_lahir' => 'required|date',
                    'jenis_kelamin' => 'required',
                    'alamat' => 'required|string',
                    'telepon' => 'nullable|string|max:255',
                    'kelas_id' => 'nullable',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ];
                break;
            case 'PATCH': // For updating an existing entry
                $rules = [
                    'nama_siswa' => 'required|string|max:255',
                    'nis' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('siswas', 'nis')->ignore($this->id),
                    ],
                    'tempat_lahir' => 'required|string|max:255',
                    'tanggal_lahir' => 'required|date',
                    'jenis_kelamin' => 'required',
                    'alamat' => 'required|string',
                    'telepon' => 'nullable|string|max:255',
                    'kelas_id' => 'nullable',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ];
                break;
        }
        return $rules;
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
            'jenis_kelamin.in' => 'Jenis Kelamin harus salah satu dari: Laki-laki, Perempuan',
            'alamat.required' => 'Alamat wajib diisi',
            'telepon.max' => 'Nomor Telepon maksimal :max karakter',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus bertipe jpeg, png, jpg, atau gif',
            'photo.max' => 'Foto maksimal :max kilobyte',
        ];
    }
}
