<div class="tweets form"> 
<?php echo $form->create('Tweet', array('action' => 'search'));?> 
    <fieldset> 
         <legend><?php __('Search tweet');?></legend> 
    <?php 
        echo $form->input('keyword'); 
    ?> 
    </fieldset> 
<?php echo $form->end('Search');?> 
</div> 
<div class="actions"> 
    <ul> 
        <li><?php echo $html->link(__('List tweets', true), array('action'=>'index'));?></li> 
    </ul> 
</div> 
