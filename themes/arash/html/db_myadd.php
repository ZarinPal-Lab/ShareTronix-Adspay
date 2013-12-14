<style>
	#fkffkkfodo9874d { width: 65%; height: 30px; font: 13px tahoma; -webkit-border-radius:5px;	-moz-border-radius:5px;	border-radius:5px;	border:1px solid #33a8e7; margin:2px; padding: 5px;}
	#fkkowreh76{

	vertical-align:middle;
width:25%;
	height:25px;
margin:5px;

	}
#db_myfllow_arash345d{
height:200px;
position:relative;

}
	
	</style>
<?
$D->all_add_company = array('1','3','6','12');
$it = 'ADD_M'

?>
	<div class="greygrad" style="margin-top:5px;">
								<div class="greygrad2">
									<div class="greygrad3" style="padding-top:0px;">
<div id="db_myfllow_arash345d">
<form action="<?=$C->SITE_URL?>payadd/tab:sabad" method="POST" target="_blank">
<textarea maxlength="128" style="height:80px;width:95%;"name="matn"></textarea>
<select name="fp_select" id="fkffkkfodo9874d"	>
<? foreach($D->all_add_company as $a){ $b = $it.$a ?>

<? if($C->$b >0 ){  ?>

<option value="<?=$a?>" ><?=$a?> ماهه : <?=$C->$b?> تومان </option>

<?}}?>	
</select>
<input type="submit" name="payfs" id="fkkowreh76" value="ثیت آگهی" /> 
<center>
<a title="128 کاراکتر برای آگهی خود بنوسید تا در بالای همین کادر نشان داده شود"href="javascript:;" style="font-size:18px;color:red;position:absolute;top:2px;left:2px;vertical-align:middle;cursor:help;font-weight:bold;text-align:right;">?</a>
</center>
</form>

</div>		

</div>	</div>	</div>	