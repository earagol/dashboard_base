<!-- Widgets  -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7f-cash"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib"> 
                            <div class="stat-text">$<span class="count"><?php echo $dataReal->monto_total?$dataReal->monto_total:''; ?></span></div>
                            <div class="stat-heading">Monto Venta <small><?php echo $fecha; ?></small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7f-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count"><?php echo $dataReal->total_ventas?$dataReal->total_ventas:''; ?></span></div>
                            <div class="stat-heading">Ventas</div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="pe-7f-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib"> 
                            <div class="stat-text"><span class="count"><?php echo $transferidas->total_transferencia?$transferidas->total_transferencia:''; ?></span></div>
                            <div class="stat-heading">N° Trans por Confirmar</div>

                            <div class="stat-text"><span class="count"><?php echo $transferidas->monto_transferencia?$transferidas->monto_transferencia:''; ?></span></div>
                            <div class="stat-heading">Monto Trans por Confirmar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($currentUser['role'] == 'admin'): ?>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7f-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-text"><span class="count"><?php echo $clientes->total_clientes?$clientes->total_clientes:''; ?></span></div>
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
        <div class="col-lg-6 col-xl-6 col-sm-12"> 
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Clientes</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th class="avatar">Nombre</th>
                                    <th>Email</th>
                                    <th>Telefono 1</th>
                                    <th>Telefono 2</th>
                                    <th>Monto</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php if($clienteTransPen): ?>
                                    <?php foreach ($clienteTransPen as $key => $value) : ?>
                                            <tr>
                                                <td class="serial"><?php echo $value->id; ?></td>
                                                <td> <?php echo $value->nombres; ?> </td>
                                                <td> <span class="name"><?php echo $value->email; ?></span> </td> 
                                                <td><span class="product"><?php echo $value->telefono1; ?></span> </td>
                                                <td><?php echo $value->telefono2; ?></td>
                                                <td><span class="count"><?php echo number_format($value->_matchingData['Ventas']->monto_transferencia, 0, ",", "."); ?></span></td>
                                                <td> 
                                                    <button class="change badge badge-complete" data-id="<?php echo $value->_matchingData['Ventas']->id; ?>">Confirmar</button>
                                                </td> 
                                            </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                        <tr class="pb-0">
                                            <td class="serial"></td>
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

        <div class="col-lg-6 col-xl-6 col-sm-12"> 
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Visitas Pendientes</h4>
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
                                                    <small class="badge badge-pending">Pendiente</small>
                                                </td> 
                                            </tr>
                                    <?php endforeach; ?>
                                 <?php else: ?>
                                        <tr class="pb-0">
                                            <td class="serial"></td>
                                            <td></td>
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
    </div> 
</div> <!-- /.order -->

<div id="container">
  
 
  
</div>
    


        <script type="text/javascript">
            var url1 = '<?php echo $url; ?>';
            var csrfToken = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>;
            (function( $ ) {
                $( document ).ready(function() {

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
                    // "use strict"; 

                    // Pie chart flotPie1 
                    var piedata = [
                        { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                        { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                        { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
                    ];

                    $.plot('#flotPie1', piedata, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                innerRadius: 0.65,
                                label: {
                                    show: true,
                                    radius: 2/3,
                                    threshold: 1
                                },
                                stroke: { 
                                    width: 0
                                }
                            }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true
                        }
                    });

                    // Pie chart flotPie1  End




                    var cellPaiChart = [
                        { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                        { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'} 
                    ];
                    $.plot('#cellPaiChart', cellPaiChart, {
                        series: {
                            pie: {
                                show: true,
                                stroke: { 
                                    width: 0
                                }
                            }
                        },
                        legend: {
                            show: false
                        },grid: {
                            hoverable: true,
                            clickable: true
                        }
                        
                    });

                    var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

                    var plot = $.plot($('#flotLine5'),[{
                        data: newCust,
                        label: 'New Data Flow',
                        color: '#fff'
                    }],
                    {
                        series: {
                            lines: {
                                show: true,
                                lineColor: '#fff',
                                lineWidth: 2
                            },
                            points: {
                                show: true,
                                fill: true,
                                fillColor: "#ffffff",
                                symbol: "circle",
                                radius: 3
                            },
                            shadowSize: 0
                        },
                        points: {
                            show: true,
                        },
                        legend: {
                            show: false
                        },
                        grid: {
                            show: false
                        }
                    });

                     // Line Chart  #flotLine5 End

                    // Traffic Chart using chartist
                    if ($('#traffic-chart').length) {
                        var chart = new Chartist.Line('#traffic-chart', {
                          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                          series: [
                          [0, 18000, 35000,  25000,  22000,  0],
                          [0, 33000, 15000,  20000,  15000,  300],
                          [0, 15000, 28000,  15000,  30000,  5000]
                          ]
                      }, {
                          low: 0,
                          showArea: true,
                          showLine: false,
                          showPoint: false,
                          fullWidth: true,
                          axisX: {
                            showGrid: true
                        }
                    });

                        chart.on('draw', function(data) {
                            if(data.type === 'line' || data.type === 'area') {
                                data.element.animate({
                                    d: {
                                        begin: 2000 * data.index,
                                        dur: 2000,
                                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                        to: data.path.clone().stringify(),
                                        easing: Chartist.Svg.Easing.easeOutQuint
                                    }
                                });
                            }
                        });
                    }
                    // Traffic Chart using chartist End


                    //Traffic chart chart-js 
                    if ($('#TrafficChart').length) {
                        var ctx = document.getElementById( "TrafficChart" );
                        ctx.height = 150;
                        var myChart = new Chart( ctx, {
                            type: 'line',
                            data: {
                                labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                                datasets: [
                                {
                                    label: "Visit",
                                    borderColor: "rgba(4, 73, 203,.09)",
                                    borderWidth: "1",
                                    backgroundColor: "rgba(4, 73, 203,.5)",
                                    data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                                },
                                {
                                    label: "Bounce",
                                    borderColor: "rgba(245, 23, 66, 0.9)",
                                    borderWidth: "1",
                                    backgroundColor: "rgba(245, 23, 66,.5)",
                                    pointHighlightStroke: "rgba(245, 23, 66,.5)",
                                    data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                                },
                                {
                                    label: "Targeted",
                                    borderColor: "rgba(40, 169, 46, 0.9)",
                                    borderWidth: "1",
                                    backgroundColor: "rgba(40, 169, 46, .5)",
                                    pointHighlightStroke: "rgba(40, 169, 46,.5)",
                                    data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                                } 
                                ]
                            },
                            options: {
                                responsive: true,
                                tooltips: {
                                    mode: 'index',
                                    intersect: false
                                },
                                hover: {
                                    mode: 'nearest',
                                    intersect: true
                                }

                            }
                        } );
                    }
                    //Traffic chart chart-js  End 



                    // Bar Chart #flotBarChart
                    $.plot("#flotBarChart", [{
                        data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                        bars: {
                            show: true,
                            lineWidth: 0,
                            fillColor: '#ffffff8a'
                        }
                    }], {
                        grid: {
                            show: false
                        }
                    });
                    // Bar Chart #flotBarChart End

                });  // End of Document Ready 
            })(jQuery);
        </script>
      

