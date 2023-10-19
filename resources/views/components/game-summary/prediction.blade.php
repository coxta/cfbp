<div class="rounded-lg bg-white shadow p-3">
    
    {{-- <h2 class="text-slate-700 font-semibold text-sm pb-2">Prediction</h2> --}}

    <div class="w-full flex flex-row items-center justify-around">
        <canvas id="prediction"></canvas>
    </div>

    <script type="text/javascript">

        var labels =  {{ Js::from($labels) }};
        var colors =  {{ Js::from($colors) }};
        var chances =  {{ Js::from($chances) }};

        var fav =  {{ Js::from($fav) }};

        const data = {
            labels: labels,
            datasets: [{
                data: chances,
                backgroundColor: colors,
                hoverOffset: 4
            }]
        };

        const nutLabel = {
            id: 'nutLabel',
            beforeDatasetsDraw(chart, args, pluginOptions) {
                const { ctx, data } = chart;
                ctx.save();
                const xCoor = chart.getDatasetMeta(0).data[0].x;
                const yCoor = chart.getDatasetMeta(0).data[0].y;
                ctx.font = 'bold 18px sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(fav, xCoor, yCoor);
            }
        }

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                cutout: '70%',
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
                plugins: {
                    legend: false,
                    title: {
                        display: true,
                        text: 'ESPN FPI Matchup Prediction'
                    }
                }
            },
            plugins: [nutLabel],
        };
  
        const myChart = new Chart(
          document.getElementById('prediction'),
          config
        );

  </script>

</div>