<?php foreach ($usuarios as $u):?>
 
 <tr>
 <td><input type="radio" name="editar" value="<?=$u->user_id?>"/></td>
 <td><?=$u->username?></td>
 <td><?=$u->password?></td> 
 </tr>
 
 <?php endforeach;?>