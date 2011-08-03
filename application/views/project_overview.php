<h3><?=$p['name']?></h3>
<p>started on <?=date('F jS, Y',strtotime($p['created']))?></p>

<section>
	<h3>Tags that I have</h3>
	
	<ol class="dash-list">				
	<? foreach($p['tags'] as $p_tag) : ?>
		<? if($p_tag['lvl'] > 0 || $p_tag['turns_to_complete'] > 0) : ?>		

		<li class="clearfix">
			<a href="#" class="tag"><?= $p_tag['name']?> <span class="level"><?= $p_tag['lvl']?></span></a><? if($p_tag['goal']>0) { ?> <?= $p_tag['progress']?> / <?=$p_tag['goal']?><? } ?>
		</li>
		<? endif; ?>
	<? endforeach; ?>
	</ol>
	
</section>

<section>
    
	<h3>Tags that I can add</h3>
    <ol class="dash-list">
    <? foreach($t as $k => $v) : ?>
        <? //if($v['lvl'] < 1 && $v['goal'] < 1) : ?>
        <li class="clearfix">
            <a href="<?=base_url()?>project/addtag/<?= $p['id'] ?>/<?=$k?>" class="add-tag">Add</a>
            <a href="#" class="tag t0"><?= $v['name']?> <span class="level">0</span></a>
        </li>
		<? //endif; ?>
    <? endforeach; ?>
    </ol>
	
</section>
