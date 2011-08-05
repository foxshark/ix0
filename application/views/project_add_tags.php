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