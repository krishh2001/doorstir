<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamOrderController extends Controller
{
    public function index()
    {
        return view('admin.stream_order.index');
    }
    public function create()
    {
        return view('admin.stream_order.create');
    }
  public function edit()
    {
        return view('admin.stream_order.edit');
    }
  public function view()
    {
        return view('admin.stream_order.view');
    }
}
