<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
                    'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $this->id,
                    'status_id' => 'required',
                ];
                break;

            case 'PATCH': // For updating an existing entry
                $rules = [
                    'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $this->id,
                    'status_id' => 'required',
                ];
                break;
        }

        return $rules;
    }
}
