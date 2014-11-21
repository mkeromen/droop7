<?php

namespace Droop7\Service;

class Request {

    /**
     * @param $pagesPrefix
     * @return bool
     */
    public function isOnTermPage($pagesPrefix) {

        if(arg(0) == 'taxonomy' && arg(1) == 'term') {
            $paths = explode('/', drupal_get_path_alias());
            $path_intersect = array_intersect($pagesPrefix, $paths);
            return !empty($path_intersect);
        }

        return false;
    }

    /**
     * @param $nodeType
     * @return bool
     */
    public function isOnNodePage($nodeType) {

        if(arg(0) == 'node' && is_numeric(arg(1))) {
            $node = node_load(arg(1));
            return ($node->type == $nodeType);
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getNodeType() {
        if(arg(0) == 'node' && is_numeric(arg(1))) {
            $node = node_load(arg(1));
            return $node->type;
        }

        return false;
    }

    /**
     * @param $machine_name_table
     * @return mixed
     */
    public function loadTitleByMachineName($machine_name_table, $value) {
        $query = db_query('SELECT n.nid, n.title FROM {node} n
          INNER JOIN {field_data_' . $machine_name_table . '} mn ON n.nid = mn.entity_id
          WHERE ' . $machine_name_table . '_value = :value', array(':value' => $value));

        return $query->fetchObject();
    }
}