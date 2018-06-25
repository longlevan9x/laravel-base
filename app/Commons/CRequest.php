<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/20/2018
 * Time: 11:53 AM
 */

namespace App\Commons;



use Illuminate\Http\Request;

class CRequest
{
    /**
     * @param array $appends
     * @return array
     */
    public static function prepareExtraFields($appends = []) {

        $fields = \request('extraFields');
        $field_list = explode(',', $fields);
        $field_return = [];
        foreach ($field_list as $index => $item) {
            if (in_array($item, $appends)) {
                $field_return[] = $item;
            }
        }
        return $field_return;
    }
}