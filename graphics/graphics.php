<script>
    // inicio del 
</script>

<?php include("../controllers/controllerGP.php"); ?>

<?php $labelsPie = json_encode($attendanceData['labels']); ?>

<script>
    const pie = document.getElementById("pie").getContext("2d");
    const bar = document.getElementById("bar").getContext("2d");

    // Gráfico de pastel (pie chart)
    let graphicsPie = new Chart(pie, {
        type: 'pie',
        data: {
            labels: <?php echo $labelsPie ?>,
            datasets: [{
                data: <?php echo json_encode($attendanceData['data']); ?>,
                backgroundColor: <?php
                                    echo '[';
                                    foreach ($attendanceData['labels'] as $label) {
                                        switch ($label) {
                                            case 'Tardanza':
                                                echo '"#F96A1E", ';
                                                break;
                                            case 'Puntual':
                                                echo '"#008000", ';
                                                break;
                                            case 'Justificacion':
                                                echo '"#187FC1", ';
                                                break;
                                            case 'Falto':
                                                echo '"#FF0000", ';
                                                break;
                                            default:
                                                echo '"#1AA220", ';
                                                break;
                                        }
                                    }
                                    echo ']';
                                    ?>
            }]
        }
    });
</script>

<?php include("../controllers/controllerGL.php"); ?>

<script>
    var graphicsLine = new Chart(line, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_reverse($labelsLine)); ?>,
            datasets: [{
                    label: 'Asistencia Mensual Puntual',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    data: <?php echo json_encode(array_reverse($dataPunctual)); ?>,
                    backgroundColor: '#26D107',
                    borderWidth: 1
                },
                {
                    label: 'Faltas Mensuales',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    data: <?php echo json_encode(array_reverse($dataAbsent)); ?>,
                    backgroundColor: '#FF0000',
                    borderWidth: 1
                }

            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include("../controllers/controllerGB.php"); ?>

<script>
    var graphicsBar = new Chart(bar, {
        type: "bar",
        data: {
            labels: <?php echo json_encode(array_reverse($labelBarD)); ?>,
            datasets: [{
                    label: "Tardanzas mensuales",
                    borderColor: 'rgba(179, 192, 185, 1)',
                    borderWidth: 1,
                    backgroundColor: '#F96A1E',
                    data: <?php echo json_encode(array_reverse($dataD)); ?>
                },
                {
                    label: "Justificaciones mensuales",
                    borderColor: 'rgba(179, 192, 255, 1)',
                    borderWidth: 1,
                    backgroundColor: '#187FC1',
                    data: <?php echo json_encode(array_reverse($dataJ)) ?>
                }
            ]

        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 5
                }
            }
        }

    })
</script>
