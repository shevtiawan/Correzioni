<?php
echo $this->Rss->header();

if (!isset($channel)) {
	$channel = array(
	    'title' => 'Correzioni - ' . $title_for_layout
	);
}

echo $this->Rss->document(
	$this->Rss->channel(
		array(),
		$channel,
		$content_for_layout
	)
);
