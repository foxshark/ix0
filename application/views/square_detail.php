<div>
    <h3>Stats</h3>
    <p>Owner: <strong class="user_<?=$def_user['id']?>"><?=$def_user['name'] ?></strong></p>
    <p>Location: <strong><?= $square['lat_id']?>, <?= $square['lon_id']?></strong></p>
    <p>Square LVL: <strong><?=$square['lvl'] ?></strong></p>
    <p><span class="fort">Fort LVL: <strong><?=$square['fort_lvl'] ?></strong></span><br>
    <span class="resource">Resources: <strong><?=$square['resource_value'] ?></strong></span></p>
</div>

<? if($this->session->userdata('id') == $def_user['id']) 
	 {	 // MY SQUARE ?>
     
    <form action="<?=base_url()?>build" method="post">
        
        <h3>Upgrade fort</h3>
        <input name="lat_id" type="hidden" value="<?= $square['lat_id']?>" />
        <input name="lon_id" type="hidden" value="<?= $square['lon_id']?>" />
        
        <label>Cost to upgrade: <strong><?= $square['upgrade_cost'] ?></strong></label>
        <input name="submit" type="submit" value="Upgrade">
        
    </form>
	 
<? } else { ?>

    <form action="<?=base_url()?>attack" method="post">
    
        <h3>Attack</h3>
        <input name="lat_id" type="hidden" value="<?= $square['lat_id']?>" />
        <input name="lon_id" type="hidden" value="<?= $square['lon_id']?>" />
        
        <label for="attack_troop_count">Purchase Troops:</label>
        <input name="troop_count" type="text" value="0" size="1" maxlength="3">
        
        <input name="submit" type="submit" value="Fight">
        
    </form>

<? } ?>