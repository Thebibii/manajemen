export const initChartSeven = () => {
    const chartElement = document.querySelector("#chartSeven");
    if (!chartElement) return;

    const { labels, series } = window.__chartSevenData ?? {
        labels: ["Diterima", "Pending", "Ditolak"],
        series: [0, 0, 0],
    };

    const chartOptions = {
        series,
        labels,
        colors: ["#17B26A", "#F79009", "#F04438"],
        chart: {
            fontFamily: "Outfit, sans-serif",
            type: "donut",
            height: 212,
            toolbar: { show: false },
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "65%",
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: "Total",
                            formatter: (w) =>
                                w.globals.seriesTotals.reduce(
                                    (a, b) => a + b,
                                    0
                                ),
                        },
                    },
                },
            },
        },
        dataLabels: { enabled: false },
        legend: { show: false },
        tooltip: {
            y: {
                formatter: (val) => `${val}  ${window.translations.pendaftar}`,
            },
        },
    };

    setTimeout(() => {
        const chart = new ApexCharts(chartElement, chartOptions);
        chart.render();
    }, 150);
};

export default initChartSeven;
