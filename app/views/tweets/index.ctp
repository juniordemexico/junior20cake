<div class="tweets index"> 
<h2><?php __('Tweets');?></h2> 
<?php echo $this->Html->Image('icons/devine/white/Twitter.png',array('height'=>32,'width'=>32));?>
<table id="monitorgrid" cellpadding="0" cellspacing="0"> 
<?php 
$i = 0; 
foreach ($results as $result): 
foreach ($result as $oneTweet): 
    $class = null; 
    if ($i++ % 2 == 0) { 
        $class = ' class="altrow"'; 
    } 
?> 

    <tr <?php echo $class;?> id="<?php echo $oneTweet['id'];?>"> 
        <td> 
            <?php echo $oneTweet['User']['name']; ?> 
        </td> 
        <td> 
            <?php echo substr($oneTweet['created_at'],0,19); ?> 
        </td> 
        <td class="actions"> 
           <?php echo $html->link(__('Delete', true), array('action'=>'delete', $oneTweet['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oneTweet['id'])); ?> 
        </td> 
    </tr>
 	<tr <?php echo $class;?>>
        <td colspan="3"  style="font-size: 125%;"> 
            <b><?php echo $oneTweet['text']; ?> </b>
        </td> 
	</tr>
<?php endforeach; ?> 
<?php endforeach; ?> 
</table> 

<table id="monitorgrid" cellpadding="0" cellspacing="0"> 
<?php 
$i = 0; 
foreach ($results2 as $result): 
foreach ($result as $oneTweet): 
    $class = null; 
    if ($i++ % 2 == 0) { 
        $class = ' class="altrow"'; 
    } 
?> 

    <tr <?php echo $class;?> id="<?php echo $oneTweet['id'];?>"> 
        <td> 
            <?php echo $oneTweet['User']['name']; ?> 
        </td> 
        <td> 
            <?php echo substr($oneTweet['created_at'],0,19); ?> 
        </td> 
        <td class="actions"> 
           <?php echo $html->link(__('Delete', true), array('action'=>'delete', $oneTweet['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oneTweet['id'])); ?> 
        </td> 
    </tr> 
	<tr <?php echo $class;?>>
        <td colspan="3" style="font-size: 125%;"> 
            <b><?php echo $oneTweet['text']; ?></b>
        </td> 
	</tr>
<?php endforeach; ?> 
<?php endforeach; ?> 
</table> 


</div> 
<div class="actions"> 
    <ul> 
        <li><?php echo $html->link(__('Search tweets', true), array('action'=>'search')); ?></li> 
    </ul> 
</div> 
