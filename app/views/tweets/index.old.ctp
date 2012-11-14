
<div class="tweets index"> 
<h2><?php __('Tweets');?></h2> 
<table cellpadding="0" cellspacing="0"> 
<tr> 
    <th><?php echo $paginator->sort('id');?></th> 
    <th><?php echo $paginator->sort('twitter_username');?></th> 
    <th><?php echo $paginator->sort('tweet_content');?></th> 
    <th><?php echo $paginator->sort('created');?></th> 
    <th class="actions"><?php __('Actions');?></th> 
</tr> 
<?php 
$i = 0; 
foreach ($tweets as $tweet): 
    $class = null; 
    if ($i++ % 2 == 0) { 
        $class = ' class="altrow"'; 
    } 
?> 
    <tr<?php echo $class;?>> 
        <td> 
            <?php echo $tweet['Tweet']['id']; ?> 
        </td> 
        <td> 
            <?php echo $tweet['Tweet']['twitter_username']; ?> 
        </td> 
        <td> 
            <?php echo $tweet['Tweet']['tweet_content']; ?> 
        </td> 
        <td> 
            <?php echo $tweet['Tweet']['created']; ?> 
        </td> 
        <td class="actions"> 
           <?php echo $html->link(__('Delete', true), array('action'=>'delete', $tweet['Tweet']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tweet['Tweet']['id'])); ?> 
        </td> 
    </tr> 
<?php endforeach; ?> 
</table> 
</div> 
<div class="paging"> 
    <?php echo $paginator->prev('&#0171;' .__('prev', true), array('escape' => false), null, array('class'=>'disabled', 'escape' => false));?> 
 |  <?php echo $paginator->numbers();?> 
    <?php echo $paginator->next(__('next', true).' &#0187;', array('escape' => false), null, array('class'=>'disabled', 'escape' => false));?> 
</div> 
<div class="actions"> 
    <ul> 
        <li><?php echo $html->link(__('Search tweets', true), array('action'=>'search')); ?></li> 
    </ul> 
</div> 