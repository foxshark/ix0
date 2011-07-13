<div>
<div style="float:left"><h1><?= $user_details['name'] ?></h1></div>
<div style="float:right"><h1><a href="<?=base_url()?>grid">Grid</a></h1></div>
<div style="clear:both;"></div>
</div>

<div>
</div>
<form action="updateCharacter" method="post">
	Atk: <input name="atk" type="text" value="1" />
    Def: <input name="def" type="text" value="1" />
    Lvl: <input name="lvl" type="text" value="1" />
</form>
<? pre_print_r($user_details)?>