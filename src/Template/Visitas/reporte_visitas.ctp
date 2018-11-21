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
            <th>Vendedor</th>
            <th>Cliente</th>
        <?php foreach ($productos as $key => $value) { ?>
           
                <th><?php echo $value; ?></th>
            
        <?php } ?>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        
            <?php 
                if($visitas){ 

                    foreach ($visitas as $key => $visita) { ?>
                        <tr>
                            <td><?php echo utf8_encode($visita['vendedor']); ?></td>
                            <td><?php echo utf8_encode($visita['cliente']); ?></td>
                            <?php foreach ($visita['productos'] as $pro => $pros) { ?>
                                <td><?php echo $pros; ?></td>
                            <?php } ?>
                            <td><?php echo utf8_encode($visita['total']); ?></td>
                        </tr>
                    <?php } 

                }
            ?>

            <tr>
                <td colspan="2">Totales:</td>
                <?php foreach ($productoTotal as $key => $value) { ?>
                    <td><?php echo $value; ?></td>
                <?php } ?>
                <td><?php echo $total; ?></td>
            </tr>
    
    </tbody>
</table>