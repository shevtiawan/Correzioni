<?php

function rss_transform($item) {
    return array(
        'title' => $item['Product']['title'],
        'link' => array(
            'controller' => 'products',
            'action' => 'view',
            $item['Product']['slug']

        ),
        'guid' => array(
            'controller' => 'products',
            'action' => 'view',
            $item['Product']['slug']

        ),
        'description' => strip_tags($item['Product']['description']),
        'pubDate' => $item['Product']['created']

    );
}

echo $this->Rss->items($products, 'rss_transform');
