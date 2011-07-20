<?php
if(!empty($sections))
{
	foreach($sections as $section => $label)
	{
		if($section == 'database')
		{
			print('<div class="sections section-'.$section.'">');
			print('<h2>'.$label);
			if(isset($description[$section]))
			{
				print('<span>'.$description[$section].'</span>');
			}
			print('</h2>');
			
			print('<div class="left">');
			
			print('<p>List of defined database configuration settings.</p>');
			
			print('<table>');
			print('<tr>');
			print('<td>&raquo; Database</td>');
			print('<td> =&gt;</td>');
			print('<td>'.$data[$section]['database'].'</td>');
			print('</tr>');
			if(isset($data[$section]['hostname']))
			{
				print('<tr>');
				print('<td>&raquo; Hostname</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['hostname'].'</td>');
				print('</tr>');
			}
			if(isset($data[$section]['username']))
			{
				print('<td>&raquo; Username</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['username'].'</td>');
				print('</tr>');
			}
			if(isset($data[$section]['password']))
			{
				print('<td>&raquo; Password</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['password'].'</td>');
				print('</tr>');
			}
			if(isset($data[$section]['dbdriver']))
			{
				print('<td>&raquo; Database Driver</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['dbdriver'].'</td>');
				print('</tr>');
			}
			if(isset($data[$section]['dbprefix']))
			{
				print('<td>&raquo; Database Prefix</td>');
				print('<td> =&gt;</td>');
				print('<td>'.$data[$section]['dbprefix'].'</td>');
				print('</tr>');
			}
			print('</table>');
			print('</div>');
			
			
			print('<div class="left right">');
			print('<div class="overflow">');
			print('<table>');
			print('<tr>');
			print('<td>&raquo; Number of queries executed</td>');
			print('<td> =&gt;</td>');
			print('<td>'.$data[$section]['total'].'</td>');
			print('</tr>');
			print('<tr>');
			print('<td colspan="3">&nbsp;</td>');
			print('</tr>');
			if(!empty($data[$section]['sql']))
			{
				foreach($data[$section]['sql'] as $record)
				{
					print('<tr>');
					print('<td>&raquo; Query</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['sql'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td>&raquo; Execution Time</td>');
					print('<td> =&gt;</td>');
					print('<td>'.$record['time'].'</td>');
					print('</tr>');
					print('<tr>');
					print('<td colspan="3">&nbsp;</td>');
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