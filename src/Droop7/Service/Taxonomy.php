<?php

namespace Droop7\Service;

class Taxonomy {

    /**
     * @param $vocabulary
     * @return array
     */
    public function getTermsByVocabulary($vocabulary, $parent = 0, $depth = null, $full = false) {

        $vocabulary = taxonomy_vocabulary_machine_name_load($vocabulary);
        return taxonomy_get_tree($vocabulary->vid, $parent, $depth, $full);
    }

    /**
     * @param $tid
     * @return bool
     */
    public function hasTermParents($tid) {

        $parent = taxonomy_get_parents($tid);
        return (!empty($parent));
    }

    /**
     * @param $term
     * @param $field
     * @return mixed
     */
    public function getTaxonomyTermFieldValue($term, $field) {

        $field = field_get_items('taxonomy_term', $term, $field);
        return $field[0]['value'];
    }

    /**
     * @param $vocabulary
     * @return bool
     */
    public function isTaxonomyTermPage($vocabulary) {
        if(arg(0) == 'taxonomy' && arg(1) == 'term') {
            $term = taxonomy_term_load(arg(2));
            return ($term->vocabulary_machine_name == $vocabulary);
        }
    }

    /**
     * @param $field
     * @param $vocabulary
     * @param $value
     * @return mixed
     */
    public function getTermIdByMachineName($field, $vocabulary, $value) {
        $query = db_query('SELECT taxofield.entity_id FROM {field_data_' . $field . '} taxofield
          WHERE ' . $field . '_value = :value AND bundle = :vocabulary LIMIT 1', array(':value' => $value, ':vocabulary' => $vocabulary));

        return $query->fetchObject();
    }

    public function setTaxonomyInBreadcrumb($tid, $nodeParent = null) {

        $parents        = taxonomy_get_parents($tid);

        $breadcrumb     = array();
        $breadcrumb[]   = l(t('Home'), '<front>');
        if($nodeParent) {
            $breadcrumb[]   = l($nodeParent->title, drupal_get_path_alias('node/' . $nodeParent->nid));
        }
        foreach($parents as $parent) {
            $breadcrumb[] = l($parent->name, 'taxonomy/term/' . $parent->tid);
        }

        drupal_set_breadcrumb($breadcrumb);
    }
}