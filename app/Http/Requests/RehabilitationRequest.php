<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RehabilitationRequest extends FormRequest
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
    return [
      'nama' => 'required|string|max:191',
      'alamat' => 'required|string|max:191',
      'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
      'tanggal_lahir' => 'required|date',
      'zat' => 'required|string|max:191',
      'durasi' => 'required|string|max:191',
      'phone' => 'required|string|max:20',
    ];
  }

  public function messages()
  {
    return [
      'nama.required' => 'Nama harus diisi',
      'nama.string' => 'Nama harus berupa string',
      'nama.max' => 'Nama tidak boleh lebih dari 191 karakter',
      'alamat.required' => 'Alamat harus diisi',
      'alamat.string' => 'Alamat harus berupa string',
      'alamat.max' => 'Alamat tidak boleh lebih dari 191 karakter',
      'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
      'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
      'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
      'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
      'zat.required' => 'Zat harus diisi',
      'zat.string' => 'Zat harus berupa string',
      'zat.max' => 'Zat tidak boleh lebih dari 191 karakter',
      'durasi.required' => 'Durasi harus diisi',
      'durasi.string' => 'Durasi harus berupa string',
      'durasi.max' => 'Durasi tidak boleh lebih dari 191 karakter',
      'phone.required' => 'Phone harus diisi',
      'phone.string' => 'Phone harus berupa string',
      'phone.max' => 'Phone tidak boleh lebih dari 20 karakter',
    ];
  }

  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'status'   => Response::HTTP_UNPROCESSABLE_ENTITY,
      'message'   => 'Validation errors',
      'data'      => $validator->errors()
    ], Response::HTTP_UNPROCESSABLE_ENTITY));
  }
}
