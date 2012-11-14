
	<!-- Requested: <?php echo date('Y/m/d H:i:s');?> -->
	<!-- Generated: <?php echo date('Y/m/d H:i:s');?> -->
	<!-- User: <?php echo $session->read('Auth.User.id')>0?$session->read('Auth.User.username').' (id: '.$session->read('Auth.User.id').' group:'.$session->read('Auth.User.group_id').')':'No Auth User';?> -->
	<!-- ClientIP: <?php echo $request['client_ip']; ?> -->
	<!-- Referer: <?php echo $request['client_referer']; ?> -->
	<!-- Request: method:<?php echo $request['request_method'];  ?>  SSL:<?php echo $request['isSSL']?'YES':'NO';?> mobile:<?php echo $request['isMobile']?'YES':'NO';  ?> Ajax:<?php echo $request['isAjax']?'YES':'NO';  ?> -->
	<!-- URL: <?php echo $this->params['url']['url']; ?> -->
	<!-- Querystring: <?php if(!empty($this->params['url'])) {foreach($this->params['url'] as $key=>$value) {if($key<>'url') echo $key.'='.$value.'  ';}} ?> -->
	<!-- Controller: <?php echo $this->name; ?>  Action: <?php echo $this->action; ?> ID: <?php echo (isset($this->data['id'])?$this->data['id']:'n/a'); ?> -->

