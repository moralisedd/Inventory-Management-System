   var options = {
            series: [{
                name: 'Revenue',
                data: [26000, 36000, 32000, 48000, 56000, 62000, 42000]
            }, {
                name: 'Profit',
                data: [42000, 38000, 36000, 52000, 54000, 58000, 40000]
            }],
            chart: {
                height: 300,
                type: 'line',
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: false
                }
            },
            colors: ['#3B82F6', '#FDE68A'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            grid: {
                borderColor: '#F3F4F6',
                row: {
                    colors: ['transparent'],
                    opacity: 0.5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            xaxis: {
                categories: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: '#6B7280',
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 80000,
                tickAmount: 4,
                labels: {
                    formatter: function(val) {
                        return val.toLocaleString();
                    },
                    style: {
                        colors: '#6B7280',
                        fontSize: '12px'
                    }
                }
            },
            legend: {
                show: false
            },
            tooltip: {
                theme: 'light',
                x: {
                    show: true
                },
                y: {
                    formatter: function(value) {
                        return value.toLocaleString();
                    }
                }
            },
            annotations: {
                xaxis: [{
                    x: 'Dec',
                    borderColor: '#E5E7EB',
                    strokeDashArray: 5,
                    label: {
                        show: false
                    }
                }]
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();



        // invoices
                // Add JavaScript for any interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Function to calculate totals
            function calculateTotals() {
                const lineItems = document.querySelectorAll('.invoice-table tbody tr');
                let subtotal = 0;
                
                lineItems.forEach(item => {
                    const lineTotal = parseFloat(item.querySelector('td:last-child').innerText
                        .replace('£', '')
                        .replace(',', '')
                    );
                    subtotal += lineTotal;
                });

                const tax = subtotal * 0.1;
                const total = subtotal + tax;

                // Update totals
                document.querySelector('.totals .total-row:nth-child(1) div:last-child')
                    .innerText = `£${subtotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                document.querySelector('.totals .total-row:nth-child(2) div:last-child')
                    .innerText = `£${tax.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                document.querySelector('.totals .final div:last-child')
                    .innerText = `£${total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            }

            // Calculate initial totals
            calculateTotals();
        });