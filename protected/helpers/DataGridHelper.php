<?php

class DataGridHelper {

    public static $_ar_non_filterable_vars = array(
        'page' => 'pageNumber',
        'rows' => 'pageSize',
        'order' => 'order',
        'sort' => 'sortBy'
    );

    public static function processFilterableVars($query_object, $ar_filterable, $ar_filter_keys, $tab_prefix = 't') {

        foreach ($ar_filterable as $key => $where) {

            if (in_array($key, $ar_filter_keys)) {
                if (is_numeric($where)) {
                    $query_object->where($tab_prefix . $key . '=:' . $key, array(':' . $key => $where));
                }
                if (!is_numeric($where)) {
                    $query_object->where(array('like', $key, '%' . $where . '%'));
                }
            }
        }
    }

}
