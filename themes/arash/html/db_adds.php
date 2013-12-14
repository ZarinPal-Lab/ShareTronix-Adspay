<?  if($users_af = $this->network->get_add_me() ) {?>
<style>
#jjd87747{
border:dashed 1px #cccccc;
padding:3px;
-moz-border-radius: 6px;
border-radius: 6px;
-webkit-border-radius: 6px;
}
#jjd87747:hover{
background:#ddffda;


}
</style>
  <div class="ttl" style="margin-bottom:8px; margin-top:4px;">
                        <div class="ttl2">
                            <h3>آگهی های تصادفی</h3>

					  </div> </div>

<?


foreach($users_af as $m){ $u = $this->network->get_user_by_id($m->user_id); ?>
<div style="margin:8px;">


<? if($u){
?>

	<div class="greygrad" style="margin-top:5px;">
								<div class="greygrad2">
									<div class="greygrad3" style="padding-top:0px;">
									<div style="padding:4px;"><img style="vertical-align:middle"src="<?=$C->IMG_URL.'avatars/thumbs2/'.$u->avatar?>"/> آگهی از <a href="<?= userlink($u->username)?>" target="_blank"><?=$u->username?></a></div>
									<div id="jjd87747" style="">
									<p style="font-size:11px"><?=$m->matn?></p>
									</div>
									
									
									</div></div></div>

<?}?>






<? } ?>


<? } ?>