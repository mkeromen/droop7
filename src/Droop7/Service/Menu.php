<?php

namespace Droop7\Service;

class Menu {

    /**
     * @param string $menuName
     * @param int $maxDepth : Pass - 1 for non limit recursivity
     * @return array
     */
    public function createSubMenu($menuName = 'main-menu', $maxDepth = 4) {

        $current_path_alias = explode('/', drupal_get_path_alias());
        $menu_data = menu_tree_page_data($menuName, $maxDepth);

        $markup = array();
        foreach($menu_data as $links) {

            $markup[] = array(
                'title' => '<p><a href="' . url($links['link']['link_path']) . '">' . $links['link']['link_title'] . '</a></p>',
                'links' => $this->getChilds($links, $maxDepth)
            );

            if(drupal_get_path_alias($links['link']['link_path']) == $current_path_alias[0]) break;
        }

        return $markup;
    }

    private function getChilds($links, $maxDepth = 4) {

        $html = '';
        if(isset($links['below']) && !empty($links['below'])) {
            $html =  '<ul>';
            foreach($links['below'] as $item) {
                if(!(bool) $item['link']['hidden']) {
                    $a_class = $li_class = '';
                    if($item['link']['in_active_trail']) {
                        $a_class = 'active active-trail';
                        if($item['link']['p' . $maxDepth] == 0) {
                            $li_class = 'active active-trail';
                            $item['link']['has_children'] ? $li_class .= " open": " ";
                        }
                    }

                    $hasChildrenClass = $item['link']['has_children'] ? "more-links":" " ;
                    $html .= "<li class=' " . $hasChildrenClass ." ". $li_class . " '>";
                    $html .= "<a href='" . url($item['link']['link_path']). "' class='" . $a_class . "'>";
                    $html .= $item['link']['link_title'];
                    $html .= "</a>";

                    if(((bool) $item['link']['has_children']) && ($item['link']['depth'] < $maxDepth) || $maxDepth == -1) {
                        $html .= $this->getChilds($item, $maxDepth);
                    }

                    $html .= "</li>";
                }
            }
            $html .= '</ul>';
        }

        return $html;
    }
}