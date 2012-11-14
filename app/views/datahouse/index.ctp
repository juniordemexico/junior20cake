<div id="frmDataHouse" class="datahouse index">
<?php echo $this->Form->create('datahouse',array('action'=>'query'));?>
<textarea id="sql" name="sql" maxlenght="1024" placeholder="Consulta..." rows="8" cols="80">
</textarea>
<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn primary', 'update' => '#results', 'url'=>array('action'=>'query')));
echo $this->Form->end(); 
?>
<?php echo $this->Form->end(); ?>
<div id="results" style="width: 90%; height: 400px; overflow: scroll; padding: 4px; margin: 4px; border 1px solid black; border-radious: 4px;">
</div>