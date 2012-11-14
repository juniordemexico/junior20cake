<?php

class AxreportComponent extends Component
{

	var $model = array();
	var $sql = '';
	var $header = array();
	var $footer = array();
	var $fields = array();
	var $rs = array();
	var $Totals = array();
	var $groupTotals = array();
	var $groupHeader = array();
	var $groupFooter = array();
	var $totalRecords = 0;
	var $isGrouped = false;
	var $actualGroup=-1;
	var $_content="";

	/* Helper's variables */
	var $Number;
	var $Date;
	
	function startup( &$controller ) {
		
		$this->controller =& $controller;
		
		//Load the Number, String and Date/Time Format Helpers
		App::import('Helper', 'Number'); 
	    $this->Number = new NumberHelper();
		App::import('Helper', 'Time'); 
	    $this->Time = new TimeHelper();

	}


	function initReport($header=array(), $fields=array(), &$rs, $sql=null )
	{
		// Determine the Groping criteria
		if(isset($header['group'])) {
			$this->isGrouped=true;
			$this->actualGroup=null;
			// Extract the Model and Field
			$split = explode(".", $header['group']['field']);
			if($split && sizeof($split)>1) {
				$theModel = ucfirst($split[0]);
				$theField = $split[1];
			}
			else {
				$theField = $split[0];
			}
			$header['group']['model']=$theModel;
			$header['group']['field']=$theField;
//			$header['groupHeader']=$header[1];
//			unset($header[1]);
		}
		else {
			$this->isGrouped=false;
			$this->actalGroup=-1;
			$this->groupTotals=array();		
		}

		// Determine the Models and Fields
		$theFields=array();
		foreach($fields as $key=>$values) {
			// Extract the Model and Field
			$split = explode(".", $values["field"]);
			if($split && sizeof($split)>1) {
				$theModel = ucfirst($split[0]);
				$theField = $split[1];
			}
			else {
				$theField = $split[0];
			}
			$theFields[$key]=$values;
			$theFields[$key]['model']=$theModel;
			$theFields[$key]['field']=$theField;

			// Set the alignment
			$theAlign="";
			switch ($values['type']) {
				case 'decimal':
				case 'decimal1':
				case 'decimal2':
				case 'decimal4':
				case 'numeric':
				case 'currency':
				case 'integer':
					$theAlign='right';
					break;
				case 'char':
				case 'boolean':
					$theAlign='center'; break;
				case 'date':
				case 'datetime':
				case 'timestamp':
				default:
					$theAlign='left';				
			}
			if(!isset($values['align'])) $theFields[$key]['align']=$theAlign;				
			
			// Initialize global Totalize for the Column
			if(isset($values['totalize']) && $values['totalize']) {
				$this->Totals[$theModel][$theField]['total']=0;
				$this->groupTotals[$theModel][$theField]['total']=0;
			}
			
			// Initialize global Counter for the Column
			if(isset($values['count']) && $values['count']) {
				$this->Totals[$theModel][$theField]['count']=0;
				$this->groupTotals[$theModel][$theField]['count']=0;
			}

			// Initialize global Average for the Column
			if(isset($values['average']) && $values['average']) {
				$this->Totals[$theModel][$theField]['average']=0;
				$this->groupTotals[$theModel][$theField]['average']=0;
			}
		}

		//  Set the Instance Propierties
		$this->header =$header;
		$this->fields =$theFields;
		$this->rs =& $rs;
		if($sql) $this->sql=$sql;
		$this->totalRecords = sizeof( $this->rs );
	}

	function getContent() {
		return ($this->_content);
	}

	function generateHTML() {

		$this->_content.="<div class=\"report ".
						$this->header['reportFormat']['size'].'-'.$this->header['reportFormat']['orientation'].
						"\">\n\n";
		$this->_generateHeader();
		$this->_content.='<div class="reportcontent">'.
		"\n\n<table class=\"report\" cellspacing=\"0\" cellpadding=\"0\">\n";
		$this->_generateColumnHeaders();
		$this->_generateRecords();
		$this->_generateTotals();
		$this->_content.=	"</table> <!-- table class report -->\n\n".
							"</div> <!-- div class report content -->\n\n";
		$this->_generateFooter();
		$this->_content.="</div> <!-- div class report -->\n\n";
	}
	
	function _generateHeader() {
		$out="<header>\n\n<div class=\"reportheader\">\n";

		// Report Title and Subtitle
		$out.="<div class=\"columnleft\">\n";
		$out.='<h1>'.$this->header['reportHeader']['title'].'</h1>'."\n";
		if(isset($this->header['reportHeader']['title'])) {
			$out.='<h2>'.$this->header['reportHeader']['title'].'</h2>'."\n";
		}
		$out.="</div> <!-- div class columnleft-->\n\n";

		// Report Ranges and Order
		$out.="<div class=\"columnright ranges\">\n";
		foreach($this->header['reportHeader']['ranges'] as $key=>$value) {
			if(!empty($value)) {
				$out.="<span class=\"label\">".$key.':</span> '.$value."<br/>\n";
			}	
		}
		$out.="</div>  <!-- div class columnright -->\n\n";
		$out.="</div>  <!-- div class reportheader -->\n\n";
		$out.="</header>\n\n";
		$this->_content.=$out;
	}
	
	function _generateColumnHeaders() {
		$upperRow='';
		$lowerRow='';

		$containColumnGroups=false;
		foreach($this->header['columnHeaders'] as $item) {
			if(is_array($item) && !is_string($item)) {
				$containColumnGroups=true;
				foreach($item as $groupTitle=>$groupItems) {
					$upperRow.='<th colspan="'.sizeof($groupItems).'">'.$groupTitle.'</th>'."\n";
					foreach($groupItems as $groupItem) {
						$lowerRow.='<th>'.$groupItem.'</th>'."\n";
					}
				}
			}
			else {
				$upperRow.='<th>&nbsp;</th>'."\n";
				$lowerRow.='<th>'.$item.'</th>'."\n";			
			}
		}
		$out="<thead>\n";
		if($containColumnGroups) {
			$out.='<tr class="header">'.$upperRow.'</tr>'."\n";
		}
		$out.='<tr class="header">'.$lowerRow.'</tr>'."\n";
		$out.="</thead>\n\n";
		$this->_content.=$out;
	}

	function _generateRecords() {
		$this->_content.="<tbody>\n\n";
		$this->actualGroup=-1;
		$lastRecord=array();
		foreach($this->rs as $record) {
			if($this->actualGroup<>
				$record[$this->header['group']['model']][$this->header['group']['field']]) {
				if($this->actualGroup<>-1) {
					$this->_generateGroupFooter();					
				}
				$this->_generateGroupHeader($record);
				$this->actualGroup=$record[$this->header['group']['model']][$this->header['group']['field']];
//				echo "Grupo:".$record[$this->header['group']['model']][$this->header['group']['field']];
			}
			
			$this->_content.=$this->_generateRow($record);
			$lastRecord=$record;
		}

		$this->_content.="\n</tbody>\n\n";
	}

	function _generateRow(&$record) {
		$out="<tr>\n";
		foreach($this->fields as $key=>$field) {
			$out.=$this->_generateCell($key, $field, $record);
		}
		$out.="</tr>\n";

		return($out);	
	}

	function _generateCell($key, $column, &$record, $columnType='record' ) {
		$out='<td class="';
		$out.=$column['align'];	// Default Alignment
		if(isset($column['width']) && $column['width']>0) $out.=' span'.$column['width']; // Default Width
		if(isset($column['text-style'])) $out.=' '.$column['text-style']; // Font-Style
		if(isset($column['style'])) $out.=' '.$column['style']; // Any other cell's style
		$out.='">';

		// Generate the cell's Hyperlink if required

		if(isset($column['link'])) {
			$out.='<a href="';
			// Generate the full hyperlink's url
			$out.=$column['link']['url'].'/'.$record[$column['link']['model']][$column['link']['field']].
			$out.='" target="_blank">';		
		}

		switch ($column['type']) {
			case 'decimal':
			case 'decimal1':
				$out.=$this->Number->format($record[$column['model']][$column['field']], array('places'=>1, 'before'=>false)); break;
			case 'percent':
				$out.=$this->Number->toPercentage($record[$column['model']][$column['field']], 2); break;
			case 'currency':
			$out.=$this->Number->currency($record[$column['model']][$column['field']], array('places'=>2)); break;
			case 'decimal2':
				$out.=$this->Number->format($record[$column['model']][$column['field']], array('places'=>2, 'before'=>false)); break;
			case 'decimal4':
				$out.=$this->Number->format($record[$column['model']][$column['field']], array('places'=>4, 'before'=>false)); break;
			case 'numeric':
				$out.=$this->Number->format($record[$column['model']][$column['field']], array('before'=>false)); break;
			case 'integer':
				$out.=$this->Number->format($record[$column['model']][$column['field']], array('places'=>0, 'before'=>false)); break;
			case 'date':
				$out.=substr($record[$column['model']][$column['field']],2,8); break;
			case 'datetime':
			case 'timestamp':
				$out.=substr($record[$column['model']][$column['field']],2,14); break;
			case 'char':
			case 'boolean':
				$out.=substr(trim($record[$column['model']][$column['field']]),0,1); break;
			default:
				$out.=trim($record[$column['model']][$column['field']]);
		}

		// Acumulates Group Totals
		if($this->isGrouped) $this->_acumulateGroupTotal($column, $record);

		// Acumulates Grand Totals
		$this->_acumulateTotal($column, $record);

		// Close the cell's Hyperlink if required
		if(isset($column['link'])) $out.='</a>'; 
	
		$out.="</td>\n";
		return($out);
	}


	function _acumulateTotal(&$column, &$record) {
		// Acumulates Grand Totals
		if(isset($column['totalize']) && $column['totalize']) {
			$this->Totals[$column['model']][$column['field']]['total']+=$record[$column['model']][$column['field']];
		}

		if(isset($column['count']) && $column['count'] && ($record[$column['model']][$column['field']]) ) {
			$this->Totals[$column['model']][$column['field']]['count']+=1;
		}
	}


	function _initGroupTotal(&$column) {
		// Acumulates Group Totals
		if(isset($column['totalize']) && $column['totalize']) {
			$this->groupTotals[$column['model']][$column['field']]['total']=0;
		}

		if(isset($column['count']) && $column['count'] ) {
			$this->groupTotals[$column['model']][$column['field']]['count']=0;
		}
	}	


	function _acumulateGroupTotal(&$column, &$record) {
		// Acumulates Group Totals
		if(isset($column['totalize']) && $column['totalize']) {
			$this->groupTotals[$column['model']][$column['field']]['total']+=$record[$column['model']][$column['field']];
		}

		if(isset($column['count']) && $column['count'] && ($record[$column['model']][$column['field']]) ) {
			$this->groupTotals[$column['model']][$column['field']]['count']+=1;
		}
	}


	function _generateGroupHeader(&$record) {
		$out="<tr class=\"groupheader\">\n";
		$out.='<td colspan="'.sizeof($this->fields).'">'.
				$record[$this->header['group']['model']][$this->header['group']['field']]."</td>\n";
		$out.="</tr>\n";
		$this->_content.=$out;
		return($out);
	}


	function _generateGroupFooter() {
		$out="<tr class=\"groupfooter\">\n";
		$col=0;
		foreach($this->fields as $key=>$field) {
			$out.=$this->_generateTotalCell($key, $field, $this->groupTotals);	
			$this->_initGroupTotal($field);
			$col++;
		}
		$out.="</tr>\n";
		$this->_content.=$out;
		return($out);
	}


	function _generateTotalCell($key, $column, &$record ) {
		$out='<td class="';
		$out.=$column['align'];	// Default Alignment
		if(isset($column['width'])) $out.=' span'.$column['width']; // Default Width
		if(isset($column['text-style'])) $out.=' '.$column['text-style']; // Font-Style
		if(isset($column['style'])) $out.=' '.$column['style']; // Any other cell's style
		$out.='">';

		if(isset($column['totalize']) && $column['totalize']) {
			$value=$record[$column['model']][$column['field']]['total'];
		}
		elseif (isset($column['count']) && $column['count']) {
			$value=$record[$column['model']][$column['field']]['count'];
		}
		elseif (isset($column['average']) && $column['average']) {
			$value=$record[$column['model']][$column['field']]['total']/$this->totalRecords;
		}
		else {
			$value='';
		}
		
		switch ($column['type']) {
			case 'decimal':
			case 'decimal1':
				$out.=$this->Number->format($value, array('places'=>1, 'before'=>false)); break;
			case 'percent':
				$out.=$this->Number->toPercentage($value, 2); break;
			case 'currency':
			$out.=$this->Number->currency($value, array('places'=>2)); break;
			case 'decimal2':
				$out.=$this->Number->format($value, array('places'=>2, 'before'=>false)); break;
			case 'decimal4':
				$out.=$this->Number->format($value, array('places'=>4, 'before'=>false)); break;
			case 'numeric':
				$out.=$this->Number->format($value, array('before'=>false)); break;
			case 'integer':
				$out.=$this->Number->format($value, array('places'=>0, 'before'=>false)); break;
			case 'date':
				$out.=substr($value,2,8); break;
			case 'datetime':
			case 'timestamp':
				$out.=substr($value,2,14); break;
			case 'char':
			case 'boolean':
				$out.=substr(trim($value),0,1); break;
			default:
				$out.=trim($value);
		}
	
		$out.="</td>\n";
		return($out);
	}

	function _generateTotals() {
		$out="<tfoot>\n<tr class=\"totals\">\n";
		$col=0;
		foreach($this->fields as $key=>$field) {
			$out.=$this->_generateTotalCell($key, $field, $this->Totals);	
			$col++;			
		}
		$out.="</tr>\n</tfoot>\n";
		$this->_content.=$out;
	}

	function _generateFooter() {

		$this->_content.=
		'
<div class="reportfooter">
	<table>
		<tr class="footercompany">
			<td></td>
			<td>Junior de Mexico, S.A. de C.V.</td>
			<td></td>
		</tr>
		<tr class="footerrequest">
			<td>Generado: '.date('Y-m-d H:i:s').'</td>
			<td>Usuario: '.$this->controller->Session->read('Auth.User.username').' &nbsp;&nbsp;&nbsp;&nbsp;
			Grupo('.$this->controller->Session->read('Auth.User.group_id').')</td>
			<td>Peticion: ';
		foreach($this->controller->params['url'] as $key=>$value) {
			$this->_content.=$key.'='.$value.' :: ';
		}
$this->_content.='
			</td>
		</tr>
		<tr class="footeridd">
			<td>Soporte Técnico: <a href="mailto:idd.mex@gmail.com">idd.mex@gmail.com</a></td>
			<td>AX<strong>BOS</strong> :: <strong>B</strong>ussiness <strong>O</strong>perative <strong>S</strong>ystem</td>
			<td>©2009-2012 Ingeniería de Datos (México)</td>
		</tr>
	</table>
</div>

<div class="code">
		'.
		$this->sql.
		'

</div> <!-- div class code -->

';

	}

}

