<?php

namespace App\Http\Controllers\Admin;

use App\Models\SyncHistory;
use Illuminate\Http\Request;

class SyncHistoryController extends Controller
{
    public function index() {
        $models = SyncHistory::all();
        return view('admin.sync-history.index', compact('models'));
    }
}
