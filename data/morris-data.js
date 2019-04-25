$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '1395 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '1395 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '1395 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '1395 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '1396 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '1396 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '1396 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '1396 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '1397 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '1397 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['گیلان', 'تهران', 'مازندران'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "در فروشگاه",
            value: 1560
        }, {
            label: "در انبار",
            value: 3050
        }, {
            label: "فروخته شده",
            value: 5670
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'فروردین',
            a: 5050,
            b: 1600
        }, {
            y: 'اردیبهشت',
            a: 3687,
            b: 2600
        }, {
            y: 'خرداد',
            a: 4156,
            b: 1320
        }, {
            y: 'تیر',
            a: 3625,
            b: 2569
        }, {
            y: 'مرداد',
            a: 2498,
            b: 1530
        }, {
            y: 'شهریور',
            a: 4123,
            b: 2604
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['دریافتی', 'پرداختی'],
        hideHover: 'auto',
        resize: true
    });
    
});
