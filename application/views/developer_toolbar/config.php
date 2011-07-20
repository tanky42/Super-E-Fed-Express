<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'config')
		{
			print('<div class="sections section-'.$section.'">');
			print('<h2>'.$label);
			if(isset($description[$section]))
			{
				print('<span>'.$description[$section].'</span>');
			}
			print('</h2>');
			
			print('<div class="left">');
			print('<table>');
			
			foreach($data[$section] as $config)
			{
				print('<tr>');
				print('<td>&raquo; '.$config['label'].' configuration variables</td>');
				print('</tr>');
			}
			
			print('</table>');
			print('</div>');
			
			foreach($data[$section] as $config)
			{
				print('<div class="left right sub config-'.$config['type'].'">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3"><strong>'.$config['label'].'</strong> configuration variables</td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				
				foreach($config['data'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; '.$record['field'].'</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['data'].'</td>');
					print('</tr>');
				}
				print('</table>');
				print('</div>');
				print('</div>');
			}
			
			print('</div>');
		}
	}
}
?>