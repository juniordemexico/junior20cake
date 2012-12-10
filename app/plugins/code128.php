function Code128($chaine){
  $code128="";
  if(strlen($chaine)>0){
    $z=0;
    $i=1;
    while(($i<=strlen($chaine)) and ($z==0)){
      if(((ord(substr($chaine,$i-1,1)))>=32 and (ord(substr($chaine,$i-1,1)))<=126) or ((ord(substr($chaine,$i-1,1)))==198)){
        $i++;  
      }else{
        $i=0;
        $z=1;
      }
    }
    $code128="";
    $tableB=true;
    if($i>0){
      $i=1;
      while($i<=strlen($chaine)){
        if($tableB){
          if(($i==1) or (($i+3)==strlen($chaine))){
            $mini=4;
          }else{
            $mini=6;
          }
          $mini=Testnum($mini,$chaine,$i);
          if($mini<0){
            if($i==1){
              $code128=chr(210);
            }else{
              $code128=$code128.chr(204);
            }
            $tableB=false;
          }else{
            if($i==1){
              $code128=chr(209);
            }
          }          
        }
        if(!$tableB){
          $mini=2;
          $mini=Testnum($mini,$chaine,$i);
          if($mini<0){
            $dummy=Myval(substr($chaine,$i-1,2));
            if($dummy<95){
              $dummy=$dummy+32;
            }else{
              $dummy=$dummy+105;
            }
            $code128=$code128.chr($dummy);
            $i=$i+2;
          }else{
            $code128=$code128.chr(205);
            $tableB=true;
          }          
        }
        if($tableB){
          $code128=$code128.substr($chaine,$i-1,1);
          $i++;          
        }        
      }
      for($i=1;$i<=strlen($code128);$i++){
        $dummy=ord(substr($code128,$i-1,1));
        if($dummy<127){
          $dummy=$dummy-32;
        }else{
          $dummy=$dummy-105;
        }
        if($i==1){
          $checksum=$dummy;
        }
        $checksum=($checksum+($i-1)*$dummy)%103;        
      }
      if($checksum<95){
        $checksum=$checksum+32;
      }else{
        $checksum=$checksum+100;
      }
      $code128=$code128.chr($checksum).chr(211);      
    }
  }
  return $code128;
}

function Testnum($mini,$chaine,$i){
  $mini=$mini-1;
  if(($i+$mini)<=strlen($chaine)){
    $y=0;
    while(($mini>=0) and ($y==0)){
      if((ord(substr($chaine,($i+$mini-1),1))<48) or (ord(substr($chaine,($i+$mini-1),1))>57)){
        $y=1;
        $mini=$mini+1;
      }
      $mini=$mini-1;
    }
  }
  return $mini;
}


function Myval($chaine){
  $j=1;
  $chaine2="";
  while($j<=strlen($chaine)){
    if(is_numeric(substr($chaine,$j-1,1))){
      $chaine2.=substr($chaine,$j-1,1);
      $j++;
    }else{
      break;
    }    
  }  
  return $chaine2;
}