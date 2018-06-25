<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SyncHistory
 * @property string name
 * @property integer status
 * @property string total_record
 * @property string type
 * @package App\Models
 */
class SyncHistory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['table', 'status', 'total_record', 'type'];

    /**
     * @var string
     */
    protected $table = 'sync_history';
}
