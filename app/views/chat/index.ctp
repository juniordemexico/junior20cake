<?php echo $html->script('jquery/chat'); ?>
<div id="chat_chat1" class="chat" name="chat1">
<div class="chat_window"><p>Conectando...</p></div>
<form action="/chat/post" id="chat1ChatForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST" /></div>
<input type="hidden" name="data[Chat][key]" value="chat1" id="ChatKey" /><br/><br/>
<div class="input text required"><input name="data[Chat][name]" type="hidden" id="chat1ChatName" maxlength="16" placeholder="Usuario..." value="chat" /></div>
<div class="input textarea required"><textarea name="data[Chat][message]" id="chat1ChatMessage" cols="30" rows="4" placeholder="Mensaje..." ></textarea></div>
<div class="submit"><button type="submit" class="btn btn-warning"><i class="icon icon-envelope icon-white"></i> Enviar</button></div>
</form>

<script type="text/javascript">
//<![CDATA[

          $(document).ready(function(){
            $("#chat_chat1").chat();
          });
    
//]]>
</script>
