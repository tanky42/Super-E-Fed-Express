<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'hooks')
		{
			print('<div class="sections section-'.$section.'">');
			print('<h2>'.$label);
			if(isset($description[$section]))
			{
				print('<span>'.$description[$section].'</span>');
			}
			print('</h2>');
			
			print('<div class="left">');
			print('<p>Total hooks for each Hook Points.</p>');
			print('<table>');
			
			foreach($data[$section] as $hook)
			{
				print('<tr>');
				print('<td>&raquo; Number of '.$hook['label'].' Hooks loaded</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$hook['total_hooks'].'</td>');
				print('</tr>');
			}
			
			print('</table>');
			print('</div>');
			
			
			foreach($data[$section] as $hook)
			{
				print('<div class="left right sub hook-'.$hook['point'].'">');
				print('<div class="overflow">');
				print('<table>');
				print('<tr>');
				print('<td colspan="3"><strong>'.$hook['label'].'</strong></td>');
				print('</tr>');
				print('<tr>');
				print('<td colspan="3">&nbsp;</td>');
				print('</tr>');
				foreach($hook['hooks'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Class</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['class'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; Function</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['function'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; File Name</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['filename'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; File Path</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['filepath'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
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