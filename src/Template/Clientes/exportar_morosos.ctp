


<head>
<meta charset="UTF-8">
</head>
<style>
    td, th{
        border: 1px solid;
        padding: 3px;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
</style>

<table>
    <thead>
         <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono 1</th>
            <th>Telefono 2</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <?php if($clienteMorosos): ?>
                <?php foreach ($clienteMorosos as $key => $value) : 
                        $morosoTotal+=$value->cuenta_porcobrar;
                        ?>
                        <tr>
                            <td ><?php echo $value->id; ?></td>
                            <td> <?php echo $value->nombres; ?> </td>
                            <td> <?php echo $value->email; ?> </td> 
                            <td><?php echo $value->telefono1; ?> </td>
                            <td><?php echo $value->telefono2; ?></td>
                            <td><?php echo number_format($value->cuenta_porcobrar, 0, ",", "."); ?></td> 
                        </tr>
                <?php endforeach; ?>
                    <tr class="pb-0">
                        <td class="text-right" colspan="5"><b>Total:</b></td>
                        <td><?php echo number_format($morosoTotal, 0, ",", "."); ?></td>
                    </tr>
        <?php else: ?>
                    <tr class="pb-0">
                        <td></td>
                        <td></td>
                        <td> </td> 
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
        <?php endif; ?>
    
    </tbody>
</table>


