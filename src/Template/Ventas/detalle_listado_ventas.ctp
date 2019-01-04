<div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width:10%;" scope="col">#</th>
                <th style="width:20%;" scope="col">Producto</th>
                <th style="width:10%;" scope="col">Precio Unitario</th>
                <th style="width:10%;" scope="col">Cantidad</th>
                <th style="width:10%;" scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total = 0;
                $i = 1;
                if($venta):
                    //prx($detalles);
                    foreach ($venta->venta_detalles as $key => $detalle): 
                        $total+=$detalle->total;
                    ?>
                        <tr id="row_<?php echo $key; ?>">
                            <td class="text-center"><?= $this->Number->format($i) ?></td>
                            <td><?= h($detalle->producto->nombre) ?></td>
                            <td class="text-left"><?php echo number_format($detalle->precio_unitario, 0, ",", ".");  ?> $</td>
                            <td class="text-center" id="cantidad_<?php echo $key; ?>">
                                <?php echo $this->Number->format($detalle->cantidad) ?>
                            </td>
                            <td class="text-left"><?php echo number_format($detalle->total, 0, ",", ".");  ?> $</td>
                        </tr>
                <?php 
                        $i++;
                    endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right"><b>Total:</b></td>
                        <td class="text-left"><?php echo number_format($total, 0, ",", ".");  ?> $</td>
                    </tr>
                <?php else: ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                <?php endif; ?>
        </tbody>
    </table>
</div>
