<div>
    <h3>Stats</h3>
    <? /*
    <p>Owner: <strong class="user_<?=$def_user['id']?>"><?=$def_user['name'] ?></strong></p>
    <p>Location: <strong><?= $square['lat_id']?>, <?= $square['lon_id']?></strong></p>
    <p>Square LVL: <strong><?=$square['lvl'] ?></strong></p>
    <p><span class="fort">Fort LVL: <strong><?=$square['fort_lvl'] ?></strong></span><br>
    <span class="resource">Resources: <strong><?=$square['resource_value'] ?></strong></span></p>
	*/ ?>
    <p>Location: <strong><?= $square['lat']?>, <?= $square['lon']?></strong></p>
    <p>Size: <strong><?= $square['size']?></strong></p>
</div>
<div>
<h3>Ladder</h3>
<ul>
<? if(!empty($ladder)) {
	foreach($ladder as $l) { 
	$u = $players[$l['user_id']] ?>
    <li><a href="attack/this/square">(<?=$l["user_rank"]?>) <?=$u['name']?></a></li>
    <? }} ?>
</ul>
</div>