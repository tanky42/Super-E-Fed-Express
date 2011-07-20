<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'request_headers')
		{
			print('<div class="sections section-'.$section.'">');
			print('<h2>'.$label);
			if(isset($description[$section]))
			{
				print('<span>'.$description[$section].'</span>');
			}
			print('</h2>');
			
			print('<div class="full">');
			print('<div class="overflow">');
			print('<table>');
			
			if(isset($data[$section]) && !empty($data[$section]))
			{
				foreach($data[$section] as $record)
				{
					print('<tr>');
					print('<td>&raquo; '.$record['field'].'</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['data'].'</td>');
					print('</tr>');
				}
			}
			
			print('</table>');
			print('</div>');
			print('</div>');
	
			print('</div>');
		}
	}
}
?>