<?php

namespace Mahedimaruf;

class Bikroy {

    private $base_url = 'https://bikroy.com/en/ads/';
    private $bot;

    /**
     * 
     * @param type $bot
     * @param type $config
     */
    public function __construct($bot) {
        $this->bot = $bot;
    }

    /**
     * 
     * @param type $city
     * @return type
     */
    public function start_page($city) {
        if (empty($city)) {
            echo 'City is empty';
            return NULL;
        }
        return $this->base_url . $city;
    }

    /**
     * 
     * @param type $next_link
     * @return type
     */
    public function scrap($next_link) {
        $list_page = $this->bot->request('GET', $next_link);
        $links = $list_page->filter('a.item-title.h4')->links();
        foreach ($links as $link) {
            $target = $link->getUri();
            $details_page = $this->bot->request('GET', $target);
            $name = $details_page->filter('span.poster')->eq(0)->text();
            $name = str_replace('For sale by ', '', $name);
            $number = $details_page->filter('li.clearfix > span.h3')->eq(0)->count() ? $details_page->filter('li.clearfix > span.h3')->eq(0)->text() : NULL;
            if ($number) {
                $data['details'][] = array(
                    'name' => $name,
                    'number' => $number
                );
            }
        }
        $data['nextlink'] = $list_page->filter('a.col-6.lg-3.pag-next')->count() ? $list_page->filter('a.col-6.lg-3.pag-next')->link()->getUri() : NULL;
        return $data;
    }

}
