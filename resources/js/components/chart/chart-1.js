export const initChartOne = () => {
    const chartElement = document.querySelector("#chartOne");
    if (!chartElement) return;

    const chartOneOptions = {
        series: [
            {
                name: "Pendaftar",
                data: window.__chartOneData ?? [],
            },
        ],
        colors: ["#465fff"],
        chart: {
            fontFamily: "Outfit, sans-serif",
            type: "bar",
            height: 250,
            toolbar: { show: false },
            parentHeightOffset: 0, // hapus offset tambahan
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                borderRadius: 5,
                borderRadiusApplication: "end",
            },
        },
        dataLabels: {
            enabled: false,
        },
        xaxis: {
            categories: window.__chartOneLabels ?? [],
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                rotate: -30,
                style: {
                    fontSize: "11px",
                    fontFamily: "Outfit, sans-serif",
                },
                formatter: (val) =>
                    val.length > 15 ? val.substring(0, 15) + "..." : val,
            },
        },
        legend: {
            show: false,
        },
        grid: {
            yaxis: {
                lines: { show: true },
            },
            xaxis: {
                lines: { show: false },
            },
            padding: {
                left: 0,
                right: 0,
            },
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: (val) => `${val} pendaftar`,
            },
        },
    };

    // const chart = new ApexCharts(chartElement, chartOneOptions);
    // chart.render();
    setTimeout(() => {
        const chart = new ApexCharts(chartElement, chartOneOptions);
        chart.render();
    }, 150);
    return chart;
};

export default initChartOne;
