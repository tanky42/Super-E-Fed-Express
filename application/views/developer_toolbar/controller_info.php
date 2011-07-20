<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'controller_info')
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
				if(isset($record['field']))
				{
					print('<tr>');
					print('<td>&raquo; '.$record['field'].'</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['data'].'</td>');
					print('</tr>');
				}
			}
			print('<tr>');
			print('<td>&raquo; Number of Methods in Class</td>');
			print('<td> =&gt;</td>');
			print('<td>'.$data[$section]['total_methods'].'</td>');
			print('</tr>');
			print('</table>');
			print('</div>');
			
			print('<div class="left right">');
			print('<div class="overflow">');
			print('<table>');
			print('<tr>');
			print('<td colspan="3"><strong>All Methods in Class</strong></td>');
			print('</tr>');
			print('<tr>');
			print('<td colspan="3">&nbsp;</td>');
			print('</tr>');
			
			foreach($data[$section]['methods'] as $method)
			{
				print('<tr>');
				print('<td>&raquo; '.$method['field'].'</td>');
				print('<td>=&gt;</td>');
				print('<td>'.$method['data'].'</td>');
				print('</tr>');
			}
			print('</table>');
			print('</div>');
			print('</div>');
			
			print('</div>');
		}
	}
}
?>