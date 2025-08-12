<x-layout-web>
  <div class="min-h-screen bg-gray-100 p-8">
    <h1 class="text-3xl font-bold mb-6">Normal Distribution Calculator</h1>

    <form method="POST" action="{{ route('normal.calculate') }}"
      class="bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-3 gap-4">
      @csrf
      <div>
        <label class="block font-semibold">Mean (μ)</label>
        <input type="number" step="any" name="mean" value="{{ $mean ?? '' }}" class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block font-semibold">Standard Deviation (σ)</label>
        <input type="number" step="any" name="stddev" value="{{ $stddev ?? '' }}"
          class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block font-semibold">Value (x)</label>
        <input type="number" step="any" name="value" value="{{ $x ?? '' }}"
          class="w-full border rounded p-2">
      </div>
      <div class="md:col-span-3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Calculate</button>
      </div>
    </form>

    @isset($z)
      <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Results</h2>
        <p>Z-Score: {{ number_format($z, 4) }}</p>
        <p>P(X &lt; {{ $x }}): {{ number_format($pLess, 2) }}%</p>
        <p>P(X &gt; {{ $x }}): {{ number_format($pGreater, 2) }}%</p>
      </div>

      <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Probability Density Function (PDF)</h2>
        <div id="plotly-chart"></div>
      </div>
    @endisset
  </div>

  @isset($values)
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
      var values = @json($values); // contoh range continuous (mean-4σ ... mean+4σ)
      var pdf = @json($pdfCurve);
      var mean = {{ $mean }};
      var stddev = {{ $stddev }};
      var xValue = {{ $x }};

      // Trace histogram: gunakan y = pdf tapi render sebagai bar (overlay)
      var traceHist = {
        x: values,
        y: pdf,
        type: 'bar',
        name: 'PDF Histogram',
        marker: {
          color: 'rgba(128,0,128,0.35)',
          line: {
            width: 1,
            color: 'rgba(128,0,128,0.6)'
          }
        },
        hoverinfo: 'x+y',
        opacity: 0.6
      };

      // Trace PDF curve (continuous)
      var tracePDF = {
        x: values,
        y: pdf,
        mode: 'lines',
        name: 'PDF Curve',
        line: {
          color: 'purple',
          width: 3
        }
      };

      // hitung puncak supaya tinggi garis vertical pas
      var ymax = Math.max.apply(null, pdf) * 1.05;

      // Shapes: tambah -1σ, μ, +1σ, dan x
      var shapes = [
        // -1σ
        {
          type: 'line',
          x0: mean - stddev,
          x1: mean - stddev,
          y0: 0,
          y1: ymax,
          line: {
            color: 'black',
            width: 2,
            dash: 'dash'
          }
        },
        // mean μ
        {
          type: 'line',
          x0: mean,
          x1: mean,
          y0: 0,
          y1: ymax,
          line: {
            color: 'red',
            width: 2
          }
        },
        // +1σ
        {
          type: 'line',
          x0: mean + stddev,
          x1: mean + stddev,
          y0: 0,
          y1: ymax,
          line: {
            color: 'black',
            width: 2,
            dash: 'dash'
          }
        },
        // x value
        {
          type: 'line',
          x0: xValue,
          x1: xValue,
          y0: 0,
          y1: ymax,
          line: {
            color: 'blue',
            width: 2
          }
        }
      ];

      // Anotasi label
      var annotations = [{
          x: mean - stddev,
          y: ymax,
          xanchor: 'center',
          yanchor: 'bottom',
          text: '-1σ',
          showarrow: true,
          arrowhead: 2,
          ax: 0,
          ay: -30,
          font: {
            color: 'black'
          }
        },
        {
          x: mean,
          y: ymax,
          xanchor: 'center',
          yanchor: 'bottom',
          text: 'μ = ' + mean,
          showarrow: true,
          arrowhead: 2,
          ax: 0,
          ay: -30,
          font: {
            color: 'red'
          }
        },
        {
          x: mean + stddev,
          y: ymax,
          xanchor: 'center',
          yanchor: 'bottom',
          text: '+1σ',
          showarrow: true,
          arrowhead: 2,
          ax: 0,
          ay: -30,
          font: {
            color: 'black'
          }
        },
        {
          x: xValue,
          y: ymax,
          xanchor: 'center',
          yanchor: 'bottom',
          text: 'x = ' + xValue,
          showarrow: true,
          arrowhead: 2,
          ax: 0,
          ay: -30,
          font: {
            color: 'blue'
          }
        }
      ];

      var layout = {
        title: `Normal Distribution (μ=${mean}, σ=${stddev})`,
        barmode: 'overlay',
        shapes: shapes,
        annotations: annotations,
        xaxis: {
          title: 'Value'
        },
        yaxis: {
          title: 'Probability Density'
        },
        legend: {
          orientation: 'h', // horizontal
          x: 0.5, // posisi tengah
          y: -0.2, // geser ke bawah grafik
          xanchor: 'center', // anchor di tengah
          bgcolor: 'rgba(255,255,255,0.8)',
          bordercolor: '#ccc',
          borderwidth: 1
        },
        margin: {
          t: 50,
          b: 100
        },
      };

      Plotly.newPlot('plotly-chart', [traceHist, tracePDF], layout, {
        responsive: true
      });
    </script>
  @endisset
</x-layout-web>
