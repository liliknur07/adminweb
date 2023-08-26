<?php

namespace App\Http\Controllers;

use App\Abuse;
use App\Socialization;
use App\User;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
  private function _getDatabaseConnection()
  {
    $databaseConnection = config('database.default');
    $databaseConfig = config('database.connections.' . $databaseConnection);


    return [
      'adapter' => [
        'driver' => 'Pdo_Mysql',
        'database' => $databaseConfig['database'],
        'username' => $databaseConfig['username'],
        'password' => $databaseConfig['password'],
        'charset' => 'utf8'
      ]
    ];
  }

  private function _getGroceryCrudEnterprise()
  {
    $database = $this->_getDatabaseConnection();
    $config = config('grocerycrud');

    $crud = new GroceryCrud($config, $database);
    $crud->unsetSettings()->unsetFilters();

    return $crud;
  }

  private function _show_output($output, $title = '')
  {
    if ($output->isJSONResponse) {
      return response($output->output, 200)
        ->header('Content-Type', 'application/json')
        ->header('charset', 'utf-8');
    }

    $css_files = $output->css_files;
    $js_files = $output->js_files;
    $output = $output->output;

    return view('grocery', [
      'output' => $output,
      'css_files' => $css_files,
      'js_files' => $js_files,
      'title' => $title
    ]);
  }

  public function index()
  {
    $title = "Users";

    $crud = $this->_getGroceryCrudEnterprise();
    $crud->setTable('users');
    $crud->setSkin('bootstrap-v4');
    $crud->setSubject('User', 'Users');
    $crud->columns(['name', 'last_name', 'nik', 'role_id', 'email', 'updated_at']);
    $crud->addFields(['name', 'last_name', 'nik', 'role_id', 'email', 'password']);
    $crud->editFields(['name', 'last_name', 'nik', 'role_id', 'email']);
    $crud->setRelation('role_id', 'roles', 'name');
    $crud->displayAs([
      'role_id' => 'Role',
      'nik' => 'NIK',
    ]);
    $crud->callbackAfterInsert(function ($s) {
      $user = User::find($s->insertId);
      $user->password = Hash::make($user->password);
      $user->save();
      return $s;
    });
    $crud->callbackAfterUpdate(function ($s) {
      $user = User::find($s->primaryKeyValue);
      $user->touch();
      return $s;
    });
    $output = $crud->render();

    return $this->_show_output($output, $title);
  }

  public function abuses()
  {
    $title = "Laporan Penyalahgunaan";

    $crud = $this->_getGroceryCrudEnterprise();
    $crud->setTable('abuses');
    $crud->setSkin('bootstrap-v4');
    $crud->setSubject($title, $title);
    $crud->unsetAdd()->setRead()->unsetDelete()->unsetDeleteMultiple();
    $crud->unsetReadFields(['long',]);
    $crud->columns(['status', 'kecamatan', 'lat', 'foto', 'created_at']);
    $crud->editFields(['status']);
    $crud->setRelation('user_id', 'users', '{name} {last_name}');
    $crud->setFieldUpload('foto', 'storage', asset('storage'));
    $crud->callbackColumn('lat', function ($value, $row) {
      $data = Abuse::find($row->id);
      return "<a href='https://www.google.com/maps/@".$value.",".$data->long.",15z' target='_blank'>Maps</a>";
    });
    $crud->callbackReadField('lat', function ($fieldValue, $primaryKeyValue) {
      $data = Abuse::find($primaryKeyValue);
      return "<a href='https://www.google.com/maps/@" . $data->lat . "," . $data->long . ",15z' target='_blank'>Maps</a>";
    });
    $crud->fieldType('status', 'dropdown_search', [
      'Menunggu' => 'MENUNGGU',
      'Selesai' => 'SELESAI',
    ]);
    $crud->displayAs([
      'user_id' => 'Dikonfirmasi oleh',
      'lat' => 'Koordinat'
    ]);
    $crud->defaultOrdering([
      'abuses.status' => 'ASC',
      'abuses.updated_at' => 'DESC'
    ]);
    $crud->callbackAfterUpdate(function ($s) {
      $data = Abuse::find($s->primaryKeyValue);
      $data->user_id = Auth::id();
      $data->save();
      return $s;
    });
    $output = $crud->render();

    return $this->_show_output($output, $title);
  }

  public function socializations()
  {
    $title = "Permintaan Sosialisasi P4GN";

    $crud = $this->_getGroceryCrudEnterprise();
    $crud->setTable('socializations');
    $crud->setSkin('bootstrap-v4');
    $crud->setSubject($title, $title);
    $crud->unsetAdd()->setRead()->unsetDelete()->unsetDeleteMultiple();
    $crud->columns(['status', 'instansi', 'tanggal', 'waktu', 'created_at']);
    $crud->editFields(['status']);
    $crud->setRelation('user_id', 'users', '{name} {last_name}');
    $crud->fieldType('status', 'dropdown_search', [
      'Menunggu' => 'MENUNGGU',
      'Selesai' => 'SELESAI',
    ]);
    $crud->displayAs([
      'user_id' => 'Dikonfirmasi oleh',
    ]);
    $crud->defaultOrdering([
      'socializations.status' => 'ASC',
      'socializations.tanggal' => 'ASC'
    ]);
    $crud->callbackAfterUpdate(function ($s) {
      $data = Socialization::find($s->primaryKeyValue);
      $data->user_id = Auth::id();
      $data->save();
      return $s;
    });
    $output = $crud->render();

    return $this->_show_output($output, $title);
  }

  public function rehabilitations()
  {
    $title = "Permintaan Pendampingan Rehabilitasi";

    $crud = $this->_getGroceryCrudEnterprise();
    $crud->setTable('rehabilitations');
    $crud->setSkin('bootstrap-v4');
    $crud->setSubject($title, $title);
    $crud->unsetAdd()->setRead()->unsetDelete()->unsetDeleteMultiple();
    $crud->columns(['status', 'nama', 'tanggal_lahir', 'zat', 'durasi', 'created_at']);
    $crud->editFields(['status']);
    $crud->setRelation('user_id', 'users', '{name} {last_name}');
    $crud->fieldType('status', 'dropdown_search', [
      'Menunggu' => 'MENUNGGU',
      'Selesai' => 'SELESAI',
    ]);
    $crud->displayAs([
      'user_id' => 'Dikonfirmasi oleh',
    ]);
    $crud->defaultOrdering([
      'rehabilitations.status' => 'ASC',
      'rehabilitations.created_at' => 'DESC'
    ]);
    $crud->callbackAfterUpdate(function ($s) {
      $data = Socialization::find($s->primaryKeyValue);
      $data->user_id = Auth::id();
      $data->save();
      return $s;
    });
    $output = $crud->render();

    return $this->_show_output($output, $title);
  }

  public function consultations()
  {
    $title = "Permintaan Konseling";

    $crud = $this->_getGroceryCrudEnterprise();
    $crud->setTable('consultations');
    $crud->setSkin('bootstrap-v4');
    $crud->setSubject($title, $title);
    $crud->unsetAdd()->setRead()->unsetDelete()->unsetDeleteMultiple();
    $crud->columns(['status', 'nama', 'tanggal_lahir', 'zat', 'durasi', 'created_at']);
    $crud->editFields(['status']);
    $crud->setRelation('user_id', 'users', '{name} {last_name}');
    $crud->fieldType('status', 'dropdown_search', [
      'Menunggu' => 'MENUNGGU',
      'Selesai' => 'SELESAI',
    ]);
    $crud->displayAs([
      'user_id' => 'Dikonfirmasi oleh',
    ]);
    $crud->defaultOrdering([
      'consultations.status' => 'ASC',
      'consultations.created_at' => 'DESC'
    ]);
    $crud->callbackAfterUpdate(function ($s) {
      $data = Socialization::find($s->primaryKeyValue);
      $data->user_id = Auth::id();
      $data->save();
      return $s;
    });
    $output = $crud->render();

    return $this->_show_output($output, $title);
  }
}
