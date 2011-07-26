<div style="height:800px; width:800px; border:#333333 solid 3px;">
	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
		<h3>Tags that I have</h3>
		<ol class="dash-list">
		<? if(!empty($p['tags'])){?>
		<? foreach($p['tags'] as $p_tag){
			if($p_tag['lvl'] > 0){
		?>
		<li class="clearfix">
<a href="#" class="tag"><?= $p_tag['name']?> <span class="level"><?= $p_tag['lvl']?></span></a> <?= $p_tag['progress']?> / <?=$p_tag['goal']?>
		</li>
		<? }}}?>
		</ol>
	</div>
	
	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
    <h3>Tags that I can add</h3>
    <ol class="dash-list">
    	<? if(!empty($t)){ ?>
        <? foreach($t as $k => $v){
            if($v['lvl'] < 1){
        ?>
        <li class="clearfix">
            <a href="<?=base_url()?>project/addtag/1/<?=$k?>" class="add-tag">Add</a>
            <a href="#" class="tag t0"><?= $v['name']?> <span class="level"><?= $v['lvl']?></span></a>
        </li>
        <? }}}?>
    </ol>
	</div>
</div>