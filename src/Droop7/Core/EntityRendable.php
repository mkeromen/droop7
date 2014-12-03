<?php

/*
 * This file is part of the Droop7 package.
 */

namespace Droop7\Core;

/**
 * EntityRendable can be used as wrapper to render entity_view results.
 * @author Matthieu Keromen
 */
class EntityRendable {

    private $entity;

    /**
     * Constructor.
     * @param $entity
     */
    public function __construct($entity) {

        $this->entity = $entity;

    }

    /**
     * @param bool $hasToRenderView
     * @param string $mode
     * @return array
     */
    public function render($hasToRenderView = true, $mode = 'teaser') {

        if (isset($this->entity['node'])) {

            $nids       = array_keys($this->entity['node']);
            $entities   = entity_load('node', $nids);

            if($hasToRenderView) {
                $rendableEntities = entity_view('node', $entities, $mode);
                return render($rendableEntities);
            }

            return $entities;
        }

        return array();
    }

}