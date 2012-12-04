<?php echo $session->flash();?>
<table id="list"></table>
<div id="pager"></div>
<script language="javascript">
var lastsel;
var isEditable=<?php echo "$isEditable";?>;
jQuery("#list").jqGrid(
{ 
url: '<?php echo $html->url('/'.$thecontroller.'/'.$theaction.'/'.$child_id.(isset($master_id)?'/master_id:'.$master_id:'').(isset($child_id)?'/child_id:'.$child_id:''));?>',
datatype: "json",
colNames:['COLOR','<?php echo $result['Talla']['tat0']?>','<?php echo $result['Talla']['tat1']?>','<?php echo $result['Talla']['tat2']?>','<?php echo $result['Talla']['tat3']?>','<?php echo $result['Talla']['tat4']?>','<?php echo $result['Talla']['tat5']?>','<?php echo $result['Talla']['tat6']?>','<?php echo $result['Talla']['tat7']?>','<?php echo $result['Talla']['tat8']?>','<?php echo $result['Talla']['tat9']?>'],
colModel:[ 
{name:'color_cve',index:'color_cve', width:250, editable:false, maxlength:32, sorteable: false, frozen: true, align: 'left'},
{name:'tat0',index:'ta0', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat1',index:'ta1', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat2',index:'ta2', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat3',index:'ta3', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat4',index:'ta4', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat5',index:'ta5', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat6',index:'ta6', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat7',index:'ta7', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat8',index:'ta8', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''},
{name:'tat9',index:'ta9', width:60, editable:isEditable, maxlength:8, sorteable: false, align: 'right', format: 'integer', defaultValue: ''}
],
rowNum:10,
rowList:[10,20,30],
imgpath: '/img/jqgrid',
sortname: 'id',
viewrecords: true,
sortorder: "asc",
	onSelectRow: function(id){
		if(id && id!==lastsel){
			jQuery('#list').jqGrid('restoreRow',lastsel);
			jQuery('#list').jqGrid('editRow',id,true);		
			lastsel=id;
		}
	},	
limit: 64,
height: 150,
width: 750,
showCaption: false,
editurl: '<?php // echo $html->url('/'.$thecontroller.'/'.$theaction.'edit/'.$child_id.'/master_id:'.$master_id); ?>'
 });
jQuery("#list").navGrid('navgrid',"#pager",{edit:false,add:false,del:false});
jQuery("#list").jqGrid('setFrozenColumns');

</script>
