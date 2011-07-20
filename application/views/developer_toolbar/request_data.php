<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'request_data')
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
			foreach($data[$section] as $record)
			{
				print('<tr>');
				print('<td>&raquo; Number of '.$record['label'].' variables</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$record['data']['total'].'</td>');	
				print('</tr>');
			}
			print('</table>');
			print('</div>');
			
			
			foreach($data[$section] as $record)
			{
				print('<div class="left right sub request-data-'.$record['type'].'">');
				print('<div class="overflow">');
				print('<table>');
				
				print('<tr>');
				print('<td colspan="3"><strong>'.$record['label'].'</strong></td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				
				if(!empty($record['data']['data']))
				{
					foreach($record['data']['data'] as $data)
					{
						print('<tr>');
						print('<td>&raquo; '.$data['variable'].'</td>');
						print('<td> =&gt;</td>');
						print('<td>'.$data['value'].'</td>');
						print('</tr>');
					}
				}
				else
				{
					print('<td>'.$record['data']['total'].'</td>');
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