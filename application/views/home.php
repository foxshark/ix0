<div style="height:1024px; width:1024px; border:#333333 solid 3px;">
	<? foreach($grid as $g) { ?>
	<div style="border:#999999 solid 1px; width:<?=$g['size']?>px; height:<?=$g['size']?>px; position:absolute; left:<?=$g['lat']?>px; top:<?=1024 - $g['lon']?>px;"><?=$g['id']?>: <?=$g['popularity']?></div>
    <? } ?>
</div>

<a href="<?=base_url()?>square/1000/500">attack sq 12</a>