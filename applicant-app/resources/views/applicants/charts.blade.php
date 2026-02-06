@extends('layouts.app')

@section('content')

<h1>Charts Page</h1>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<button onclick="changeChartType('bar')" class="btn-primary">Bar</button>
<button onclick="changeChartType('pie')" class="btn-primary">Pie</button>

<form method="GET" action="{{ route('applicants.charts') }}">
    <select name="group_by" onchange="this.form.submit()">
        <option value="gender" {{ request('group_by') == 'gender' ? 'selected' : '' }}>Applicants by Gender</option>
        <option value="race" {{ request('group_by') == 'race' ? 'selected' : '' }}>Applicants by Race</option>
        <option value="state" {{ request('group_by') == 'state' ? 'selected' : '' }}>Applicants by State</option>
        <option value="qualification" {{ request('group_by') == 'qualification' ? 'selected' : '' }}>Applicants by Qualification</option>
    </select>
</form>

<div style="width: 1000px; height: 500px; margin: auto;">
    <canvas id="ApplicantChart"></canvas>
</div>

<script>
    const labels = @json($labels);
    const data = @json($data);
    const chartTitle = @json($chartTitle);

    const ctx = document.getElementById('ApplicantChart').getContext('2d');

    let applicantChart; // store chart instance

    function createChart(type) {
        // Destroy old chart before creating new one
        if (applicantChart) {
            applicantChart.destroy();
        }

        applicantChart = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: chartTitle,
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: chartTitle
                    }
                }, 
                scales: type === 'pie' ? {} : {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    }

    function changeChartType(type) {
        createChart(type);
    }

    // Load default chart
    createChart('bar');
</script>
 

@endsection