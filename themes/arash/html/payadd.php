<?php
	
	$this->load_template('header.php');

?>

<? if($D->error) { ?>
<?= errorbox('خطا', $D->errmsg, TRUE, 'margin-top:5px;margin-bottom:5px;') ?>
<?php } ?>



<? if($D->sabad && $n=  $D->baste){ ?>

<?= msgbox ('آگهی متنی  '.$n['pri'].' ماهه با قیمت '.$n['amount'].' تومان', nl2br('<b>
متن آگهی شما:</b>
<p style="padding:9px;border:dashed 1px #cccccc">'.$n['matn'].'</p>
<center>
<form action="'.$C->SITE_URL.'payadd/tab:submit" method="POST" >
<input type="hidden" value="'.$n['pri'].'" name="pri_2"/>
<input type="hidden" value="'.$n['amount'].'" name="amount_2"/>
<input type="submit" value="پرداخت نهایی" name="pardakht"/>
</form>
</center>
',false))?>



<?}?>




<?php
	
	$this->load_template('footer.php');
	
?>