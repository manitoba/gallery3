<? defined("SYSPATH") or die("No direct script access."); ?>
<? echo "<?xml version=\"1.0\" ?>"; ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/"
                   xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title><?= $item->title ?></title>
    <link><?= url::site("media_rss/{$item->id}", "http") ?></link>
    <description><?= $item->description ?></description>
    <language>en-us</language>
    <? if (isset($prevOffset)): ?>
    <atom:link rel="previous" href="<?= url::site("media_rss/feed/{$item->id}?offset={$prevOffset}") ?>" />
    <? endif; ?>
    <? if (isset($nextOffset)): ?>
    <atom:link rel="next" href="href="<?= url::site("media_rss/feed/{$item->id}?offset={$nextOffset}") ?>"/>
    <? endif; ?>
    <?
      // @todo do we want to add an upload date to the items table?
      $date = date("D, d M Y H:i:s T");
    ?>
    <pubDate><?= $date ?></pubDate>
    <lastBuildDate><?= $date ?></lastBuildDate>
    <? foreach ($children as $child): ?>
      <item>
        <title><?= $child->title ?></title>
        <link><?= $child->resize_url(false, "http") ?></link>
        <guid isPermaLink="false"><?= $child->id ?></guid>
        <description><?= $child->description ?></description>
        <media:content url="<?= $child->thumbnail_url(false, "http") ?>"
          type="<?= $child->mime_type ?>"
          height="<?= $child->resize_height ?>"
          width="<?= $child->resize_width ?>"
        />
      </item>
    <? endforeach; ?>
  </channel>
</rss>