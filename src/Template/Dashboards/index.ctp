<!-- Widgets  -->
<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="card nocard">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7f-cash"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib"> 

                            <div class="stat-text"><span class="count"><?php echo $cxc->total_cxc?$cxc->total_cxc:0; ?></span></div>
                            <div class="stat-heading">N° Clientes con CXC</div>

                            <div class="stat-text">$<span class="count1"><?php echo $cxc->monto_cxc?$cxc->monto_cxc:0; ?></span></div>
                            <div class="stat-heading">Monto total CXC</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6">
        <div class="card nocard">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7f-cash"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib"> 
                            <div class="stat-text">$<span class="count"><?php echo $dataReal->monto_total?$dataReal->monto_total:0; ?></span></div>
                            <div class="stat-heading">Monto Venta <small><?php echo $fecha; ?></small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card nocard">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7f-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count1"><?php echo $dataReal->total_ventas?$dataReal->total_ventas:0; ?></span></div>
                            <div class="stat-heading">Ventas</div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card nocard">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="pe-7f-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib"> 
                            <div class="stat-text"><span class="count"><?php echo $transferidas->total_transferencia?$transferidas->total_transferencia:0; ?></span></div>
                            <div class="stat-heading">N° Trans por Confirmar</div>

                            <div class="stat-text"><span class="count1"><?php echo $transferidas->monto_transferencia?$transferidas->monto_transferencia:0; ?></span></div>
                            <div class="stat-heading">Monto Trans por Confirmar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($currentUser['role'] == 'admin'): ?>
        <div class="col-lg-3 col-md-6">
            <div class="card nocard">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7f-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-text"><span class="count"><?php echo $clientes->total_clientes?$clientes->total_clientes:0; ?></span></div>
                                <div class="stat-heading">N° Clientes</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div> 
<!-- Widgets End -->

<div class="clearfix"></div>
<div class="orders">
    <div class="row">
        <?php if($currentUser['role'] == 'admin'): ?>
            <div class="col-lg-12 col-xl-12 col-sm-12"> 
                <div class="card nocard">
                    <div class="card-body">
                        <h4 class="box-title">Clientes a confirmar transferencia</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="serial">Id</th>
                                        <th scope="avatar">Nombre</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefono 1</th>
                                        <th scope="col">Telefono 2</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php if($clienteTransPen): ?>
                                        <?php foreach ($clienteTransPen as $key => $value) : ?>
                                                <tr>
                                                    <td><?php echo $value->id; ?></td>
                                                    <td><?php echo $value->nombres; ?> </td>
                                                    <td><span><?php echo $value->email; ?></span> </td> 
                                                    <td><span><?php echo $value->telefono1; ?></span> </td>
                                                    <td><?php echo $value->telefono2; ?></td>
                                                    <td><span ><?php echo number_format($value->_matchingData['Ventas']->monto_transferencia, 0, ",", "."); ?></span></td>
                                                    <td> 
                                                        <button class="change badge badge-complete" data-id="<?php echo $value->_matchingData['Ventas']->id; ?>">Confirmar</button>
                                                    </td> 
                                                </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                            <tr class="pb-0">
                                                <td ></td>
                                                <td></td>
                                                <td> </td> 
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td> 
                                            </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div> <!-- /.card -->
            </div>  <!-- /.col-lg-8 -->
        <?php endif; ?>

        <div class="col-lg-12 col-xl-12 col-sm-12"> 
            <div class="card nocard">
                <div class="card-body">
                    <h4 class="box-title">Visitas pendientes</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="serial">Id</th>
                                    <th scope="avatar">Vendedor</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Fecha Vencimiento</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($visitasPendientes): ?>
                                    <?php foreach ($visitasPendientes as $key => $visita) : ?>
                                            <tr>
                                                <td><?php echo $this->Number->format($visita->id) ?></td>
                                                <td><?php echo h($visita->usuario->full_name) ?></td>
                                                <td><?php echo h($visita->cliente->nombres) ?></td>
                                                <td><?php echo h($visita->fecha_vencimiento->format('Y-m-d')) ?></td>
                                                <td> 
                                                    <?php echo $this->Html->link(__('<small class="badge badge-pending">Pendiente</small>'), ['controller' => 'ventas','action' => 'add', $visita->cliente_id,$visita->id],['title'=>'Realizar Venta','escape' => false]) ?>
                                                </td> 
                                            </tr>
                                    <?php endforeach; ?>
                                 <?php else: ?>
                                        <tr class="pb-0">
                                            <td ></td>
                                            <td></td>
                                            <td></td> 
                                            <td></td>
                                            <td></td>
                                        </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->

        <div class="col-lg-12 col-xl-12 col-sm-12"> 
            <div class="card nocard">
                <div class="card-body">
                    <h4 class="box-title">Clientes con cartera pendiente</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
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
                                    <?php 
                                        $morosoTotal=0;
                                        if($clienteMorosos): ?>
                                        <?php foreach ($clienteMorosos as $key => $value) : 
                                                $morosoTotal+=$value->cuenta_porcobrar;
                                                ?>
                                                <tr>
                                                    <td ><?php echo $value->id; ?></td>
                                                    <td> <?php echo $value->nombres; ?> </td>
                                                    <td> <span class="name"><?php echo $value->email; ?></span> </td> 
                                                    <td><span class="product"><?php echo $value->telefono1; ?></span> </td>
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
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div>  <!-- /.col-lg-8 -->
    </div> 
</div> <!-- /.order -->

<div id="container">
  
 
  
</div>
    


        <script type="text/javascript">
            var url1 = '<?php echo $url; ?>';
            var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;
            (function( $ ) {

                $('.change').click(function() {
                        

                        $.ajax({
                            url:url1+'ventas/confirmaTransferencia',
                            dataType: 'json',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': csrfToken
                            },
                            data:{
                                venta_id: $(this).data('id')
                            },
                            success: function(response){
                                if(response.success){
                                    location.reload();
                                }
                            }
                        });

                    });
                

                   
            })(jQuery);
        </script>
      

