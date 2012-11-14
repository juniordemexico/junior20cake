<?php
echo $html->css('jquery-ui/custom-theme/jquery-ui-1.8.16.custom', null, array(), false);
echo $html->css('jquery-ui/fileUploader', null, array(), false);

echo $html->script(array(
					'jquery/jquery.min',
					'jquery/jquery-ui.min',
					'jquery/jquery.fileUploader',
					)
				);
echo $html->script('jquery/bootstrap/bootstrap.min');
